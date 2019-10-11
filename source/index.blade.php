@extends('_layouts.master')

@section('body')
<section class="container self-center max-w-2xl mx-auto px-6">
        <div class="text-center">
            <h1 id="intro-docs-template">{{ $page->siteName }}</h1>
            <h2 id="intro-powered-by-jigsaw" class="font-light mt-4">{{ $page->siteDescription }}</h2>

            <div class="my-10">
                <a href="/docs/getting-started" title="{{ $page->siteName }} getting started" class="bg-blue hover:bg-blue-dark font-normal text-white hover:text-white rounded mr-4 py-2 px-6">Read the Docs</a>
                <a href="https://github.com/sbarry50/wp-headless-starter" title="WP Headless Starter Plugin git repository" class="bg-blue hover:bg-blue-dark font-normal text-white hover:text-white rounded mr-4 py-2 px-6" target="_blank">Starter Plugin on Github</a>
            </div>
        </div>
</section>
@endsection
