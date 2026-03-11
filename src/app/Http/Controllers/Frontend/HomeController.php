<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\ContactMail;
use App\Models\About;
use App\Models\Blog;
use App\Models\BlogSectionSetting;
use App\Models\Category;
use App\Models\ContactSectionSetting;
use App\Models\Experience;
use App\Models\Feedback;
use App\Models\FeedbackSectionSetting;
use App\Models\Hero;
use App\Models\PortfolioItem;
use App\Models\PortfolioSectionSetting;
use App\Models\PrivacyPolicy;
use App\Models\Service;
use App\Models\SkillItem;
use App\Models\SkillSectionSetting;
use App\Models\TyperTitle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    public function index() 
    {
        $hero = Cache::remember('hero', 3600, fn() => Hero::first());
        $typerTitles = Cache::remember('typer_titles', 3600, fn() => TyperTitle::all());
        $services = Cache::remember('services', 3600, fn() => Service::all());
        $about = Cache::remember('about', 3600, fn() => About::first());
        $portfolioTitle = Cache::remember('portfolio_title', 3600, fn() => PortfolioSectionSetting::first());
        $portfolioCategories = Cache::remember('portfolio_categories', 3600, fn() => Category::all());
        $portfolioItems = Cache::remember('portfolio_items_home', 3600, fn() => PortfolioItem::with('category')->latest()->get());
        $skill = Cache::remember('skill_section', 3600, fn() => SkillSectionSetting::first());
        $skillItems = Cache::remember('skill_items', 3600, fn() => SkillItem::all());
        $experience = Cache::remember('experience', 3600, fn() => Experience::first());
        $feedbacks = Cache::remember('feedbacks', 3600, fn() => Feedback::all());
        $feedbackTitle = Cache::remember('feedback_title', 3600, fn() => FeedbackSectionSetting::first());
        $blogs = Cache::remember('blogs_home', 3600, fn() => Blog::latest()->take(5)->get());
        $blogTitle = Cache::remember('blog_title', 3600, fn() => BlogSectionSetting::first());
        $contactTitle = Cache::remember('contact_title', 3600, fn() => ContactSectionSetting::first());
        return view('frontend.home', 
            compact(
                'hero', 
                'typerTitles', 
                'services', 
                'about', 
                'portfolioTitle',
                'portfolioCategories',
                'portfolioItems',
                'skill',
                'skillItems',
                'experience',
                'feedbacks',
                'feedbackTitle',
                'blogs',
                'blogTitle',
                'contactTitle'
            ));
    }

    public function portfolio()
    {
        $portfolios = PortfolioItem::latest()->paginate(9);
        return view('frontend.portfolio', compact('portfolios'));
    }

    public function showPortfolio($id)
    {
        $portfolio = PortfolioItem::findOrFail($id);
        return view('frontend.portfolio-details', compact('portfolio'));
    }

    public function showBlog($id)
    {
        $blog = Blog::findOrFail($id);
        $previousPost = Blog::where('id', '<', $blog->id)->orderBy('id', 'desc')->first();
        $nextPost = Blog::where('id', '>', $blog->id)->orderBy('id', 'asc')->first();
        return view('frontend.blog-details', compact('blog', 'previousPost', 'nextPost'));
    }

    public function blog()
    {
        $blogs = Blog::latest()->paginate(9);
        return view('frontend.blog', compact('blogs'));
    }

    public function showPrivacyPolicy()
    {
        $privacyPolicy = PrivacyPolicy::latest()->first();
        
        if (! $privacyPolicy) {
            abort(404);
        }

        return view('frontend.privacy-policy', compact('privacyPolicy'));
    }

    public function contact(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:200'],
            'subject' => ['required', 'max:300'],
            'email' => ['required', 'email'],
            'message' => ['required', 'max:2000'],
            'g-recaptcha-response' => 'required|recaptcha',
        ]);

        Mail::send(new ContactMail($request->all()));

        return response(['status' => 'success', 'message' => 'Mail Sent Sucessfully!']);
    }
}
