<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Feedback;
use App\Models\Lead;
use App\Models\PortfolioItem;
use App\Models\Service;
use App\Models\ServicePage;
use App\Models\SkillItem;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $blogCount = Blog::count();
        $skillCount = SkillItem::count();
        $portfolioCount = PortfolioItem::count();
        $feedbackCount = Feedback::count();

        $serviceCount = Service::count();
        $landingPageCount = ServicePage::count();
        $activeLandingPageCount = ServicePage::where('is_active', true)->count();

        $leadCount = Lead::count();
        $leadsThisMonth = Lead::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        $leadsByServicePage = ServicePage::withCount('leads')
            ->orderByDesc('leads_count')
            ->get();

        $recentLeads = Lead::with('servicePage')->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'blogCount',
            'skillCount',
            'portfolioCount',
            'feedbackCount',
            'serviceCount',
            'landingPageCount',
            'activeLandingPageCount',
            'leadCount',
            'leadsThisMonth',
            'leadsByServicePage',
            'recentLeads'
        ));
    }
}
