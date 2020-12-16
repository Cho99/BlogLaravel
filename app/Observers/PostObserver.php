<?php

namespace App\Observers;

use App\Models\News;

class PostObserver
{
    /**
     * Handle the news "created" event.
     *
     * @param  \App\News  $news
     * @return void
     */
    public function created(News $news)
    {
        //
    }

    /**
     * Handle the news "updated" event.
     *
     * @param  \App\News  $news
     * @return void
     */
    public function updated(News $news)
    {
        //
    }

    /**
     * Handle the news "deleted" event.
     *
     * @param  \App\News  $news
     * @return void
     */
    public function deleted(News $news)
    {
        //
    }

     /**
     * Handle the news "deleting" event.
     *
     * @param  \App\News  $news
     * @return void
     */
    public function deleting(News $news)
    {
        //
        echo "Dang xoa: ".$news->title;
    }

    /**
     * Handle the news "restored" event.
     *
     * @param  \App\News  $news
     * @return void
     */
    public function restored(News $news)
    {
        //
    }

    /**
     * Handle the news "force deleted" event.
     *
     * @param  \App\News  $news
     * @return void
     */
    public function forceDeleted(News $news)
    {
        //
    }
}
