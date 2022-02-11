<div class="row">
    <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-cyan">
            <div class="inner">
                <h3>{{ auth()->user()->customers->count() }}</h3>
                <p>@lang('statistics.customers')</p>
            </div>
            <div class="icon">
                <i class="fa fa-user-alt"></i>
            </div>
            <a href="{{ route('dashboard.users.index') }}" class="small-box-footer">
                @lang('statistics.actions.more') <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-red">
            <div class="inner">
                <h3>{{ $tasks->count() }}</h3>
                <p>@lang('statistics.tasks')</p>
            </div>
            <div class="icon">
                <i class="fa fa-suitcase"></i>
            </div>
            <a href="{{ route('dashboard.tasks.index') }}" class="small-box-footer">
                @lang('statistics.actions.more') <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-gradient-blue">
            <div class="inner">
                <h3>{{ $campaigns->count() }}</h3>
                <p>@lang('statistics.campaigns')</p>
            </div>
            <div class="icon">
                <i class="fa fa-microphone"></i>
            </div>
            <a href="{{ route('dashboard.campaigns.index') }}" class="small-box-footer">
                @lang('statistics.actions.more') <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-green">
            <div class="inner">
                <h3>{{ $schedules->count() }}</h3>
                <p>@lang('statistics.schedules')</p>
            </div>
            <div class="icon">
                <i class="fa fa-paper-plane"></i>
            </div>
            <a href="{{ route('dashboard.schedules.index') }}" class="small-box-footer">
                @lang('statistics.actions.more') <i class="fa fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        @include('dashboard.statistics.partials.task')
    </div>
    <div class="col-12">
        @include('dashboard.statistics.partials.schedule')
    </div>
    <div class="col-12">
        @include('dashboard.statistics.partials.campaign')
    </div>
</div>
