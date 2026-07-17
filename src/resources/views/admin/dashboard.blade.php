@extends('admin.layouts.layout')
@section('content')
    <section class="section">
          <div class="section-header">
            <h1>Dashboard</h1>
          </div>
          <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                  <i class="fas fa-blog"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Total Blogs</h4>
                  </div>
                  <div class="card-body">
                    {{$blogCount}}
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                  <i class="fas fa-thumbs-up"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Total Skills</h4>
                  </div>
                  <div class="card-body">
                    {{$skillCount}}
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                  <i class="far fa-file"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Total Portfolios</h4>
                  </div>
                  <div class="card-body">
                    {{$portfolioCount}}
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                  <i class="fas fa-star"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Total Feedbacks</h4>
                  </div>
                  <div class="card-body">
                    {{$feedbackCount}}
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-secondary">
                  <i class="fas fa-briefcase"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Total Services</h4>
                  </div>
                  <div class="card-body">
                    {{$serviceCount}}
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-info">
                  <i class="fas fa-file-alt"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Total Landing Pages</h4>
                  </div>
                  <div class="card-body">
                    {{$landingPageCount}}
                    <span class="text-muted" style="font-size: 13px; font-weight: 400;">({{$activeLandingPageCount}} active)</span>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                  <i class="fas fa-users"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Total Leads</h4>
                  </div>
                  <div class="card-body">
                    {{$leadCount}}
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                  <i class="fas fa-calendar-check"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Leads This Month</h4>
                  </div>
                  <div class="card-body">
                    {{$leadsThisMonth}}
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-lg-6 col-12">
              <div class="card">
                <div class="card-header">
                  <h4>Leads by Service</h4>
                </div>
                <div class="card-body">
                  @if ($leadsByServicePage->isEmpty())
                    <p class="text-muted mb-0">No landing pages yet.</p>
                  @else
                    @php $maxLeads = max($leadsByServicePage->max('leads_count'), 1); @endphp
                    @foreach ($leadsByServicePage as $sp)
                      <div class="mb-3">
                        <div class="d-flex justify-content-between">
                          <a href="{{ route('admin.leads.index', ['service_page_id' => $sp->id]) }}">
                            {{ $sp->getTranslation('title', 'en', true) }}
                          </a>
                          <strong>{{ $sp->leads_count }}</strong>
                        </div>
                        <div class="progress" style="height: 6px;">
                          <div class="progress-bar bg-primary" role="progressbar"
                               style="width: {{ ($sp->leads_count / $maxLeads) * 100 }}%"></div>
                        </div>
                      </div>
                    @endforeach
                  @endif
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-12">
              <div class="card">
                <div class="card-header">
                  <h4>Recent Leads</h4>
                </div>
                <div class="card-body">
                  @if ($recentLeads->isEmpty())
                    <p class="text-muted mb-0">No leads captured yet.</p>
                  @else
                    <div class="table-responsive">
                      <table class="table table-striped">
                        <thead>
                          <tr>
                            <th>Service</th>
                            <th>Date</th>
                            <th class="text-center">Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($recentLeads as $lead)
                            <tr>
                              <td>{{ $lead->servicePage?->getTranslation('title', 'en', true) }}</td>
                              <td style="white-space:nowrap">{{ $lead->created_at->format('d/m/Y H:i') }}</td>
                              <td class="text-center">
                                <a href="{{ route('admin.leads.show', $lead->id) }}" class="btn btn-sm btn-info">
                                  <i class="fas fa-eye"></i>
                                </a>
                              </td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                    <a href="{{ route('admin.leads.index') }}">View all leads &raquo;</a>
                  @endif
                </div>
              </div>
            </div>
          </div>

    </section>
@endsection