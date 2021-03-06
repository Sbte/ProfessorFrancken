<?php

declare(strict_types=1);

namespace Tests\Francken\Domain\Posts;

use Carbon\Carbon;
use Francken\Domain\Posts\Events\DraftDeleted;
use Francken\Domain\Posts\Events\PostContentChanged;
use Francken\Domain\Posts\Events\PostPublishedAt;
use Francken\Domain\Posts\Events\PostTitleChanged;
use Francken\Domain\Posts\Events\PostUnpublished;
use Francken\Domain\Posts\Events\PostWritten;
use Francken\Domain\Posts\Post;
use Francken\Domain\Posts\PostCategory;
use Francken\Domain\Posts\PostId;
use Francken\Tests\AggregateRootScenarioTestCase;

class PostsTest extends AggregateRootScenarioTestCase
{
    /** @test */
    public function a_post_can_be_written() : void
    {
        $id = PostId::generate();
        $type = PostCategory::fromString(PostCategory::BLOGPOST);

        $this->scenario
            ->when(function () use ($id, $type) {
                return Post::createDraft($id,
                    "Post Title",
                    "Post Content",
                    $type);
            })
            ->then([new PostWritten($id,
                    "Post Title",
                    "Post Content",
                    $type)]);
    }

    /** @test */
    public function a_title_can_be_changed() : void
    {
        $id = PostId::generate();

        $this->givenANewPost($id)
            ->when(function ($post) {
                return $post->editTitle("New Title");
            })
            ->then([new PostTitleChanged($id, "New Title")]);
    }

    /** test */
    public function content_can_be_edited() : void
    {
        $id = PostId::generate();

        $this->givenANewPost($id)
            ->when(function ($post) {
                return $post->editContent("New Content");
            })
            ->then([new PostContentChanged($id, "New Content")]);
    }

    /** @test */
    public function once_a_draft_is_created_a_publish_date_can_be_set() : void
    {
        $id = PostId::generate();
        $date = Carbon::createFromDate(2012, 1, 1);

        $this->givenANewPost($id)
            ->when(function ($post) use ($date) {
                return $post->setPublishDate($date);
            })
            ->then([new PostPublishedAt($id, $date)]);
    }

    /** @test */
    public function a_published_post_can_be_unpublished() : void
    { // reset back to draft.
        $id = PostId::generate();
        $date = Carbon::createFromDate(2012, 1, 1);

        $this->givenANewPost($id)
            ->when(function ($post) use ($date) : void {
                $post->setPublishDate($date);
                $post->unpublish();
            })
            ->then([new PostPublishedAt($id, $date),
                new PostUnpublished($id)]);
    }

    /** @test */
    public function a_draft_can_be_deleted() : void
    {
        $id = PostId::generate();

        $this->givenANewPost($id)
            ->when(function ($post) : void {
                $post->delete();
            })
            ->then([new DraftDeleted($id)]);
    }

    protected function getAggregateRootClass() : string
    {
        return Post::class;
    }

    private function givenANewPost(PostId $id)
    {
        return $this->scenario
            ->withAggregateId((string)$id)
            ->given([new PostWritten($id,
                    "Title",
                    "Content",
                    PostCategory::fromString(PostCategory::NEWSPOST))]);
    }
}
