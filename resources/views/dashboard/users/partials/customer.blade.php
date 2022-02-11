<div class="row">
    <div class="col-md-3">
        @component('Template::components.box')
            @slot('bodyClass', 'box-profile')
            <div class="card-body box-profile">
                <div class="text-center">
                    <img class="profile-user-img img-fluid img-circle" src="{{ $user->getAvatar() }}" alt="{{ $user->name }}">
                </div>

                <h3 class="profile-username text-center">{{ $user->name }}</h3>

                <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item">
                        <b>@lang($resource.'.wallet')</b>
                        <a class="float-right{{ $user->getWallet() > 0 ? ' text-success' : ' text-danger' }}">{{ $user->getWallet() }} $</a>
                    </li>
                    <li class="list-group-item list-group-unbordered">
                        <b>@lang('customers.attributes.status')</b>
                        <span class="float-right">{{ $user->isActivated() ? trans('customers.status.activated') : trans('customers.status.deactivated') }}</span>
                    </li>
                    @if(auth()->user()->isAdmin())
                        <li class="list-group-item text-center">
                            <b>@lang('supervisors.singular')</b>
                            <a href="{{ route('dashboard.users.show', $user->manager) }}">{{ $user->manager->name }}</a>
                        </li>
                    @endif
                </ul>

                @include('dashboard.users.partials.actions.edit')
                @include('dashboard.users.partials.actions.delete')
                @include('dashboard.users.partials.actions.activate')
                @include('dashboard.users.partials.actions.deactivate')

            </div>
        @endcomponent
        
        {{ BsForm::resource('packages')->put(route('dashboard.users.attachPackage', $user)) }}
        @component('Template::components.box')
            @slot('title', trans('packages.actions.create'))

            <select2
                name="id"
                id="id"
                label="@lang('packages.singular')"
                remote-url="{{ route('api.packages.select') }}"></select2>

            @slot('footer')
                {{ BsForm::submit()->label(trans('packages.actions.save')) }}
            @endslot
        @endcomponent
        {{ BsForm::close() }}
        
        @include('dashboard.achievements.create')
        @include('dashboard.transactions.create')
        @include('dashboard.attachments.create')
    </div>
    <div class="col-md-9">
        <div class="row">
            <div class="col-md-12">
                @include('dashboard.users.partials.packages')
            </div>
            <div class="col-md-12">
                @include('dashboard.users.partials.transactions')
            </div>
            <div class="col-md-12">
                @include('dashboard.users.partials.achievements')
            </div>
            @if(auth()->user()->isAdmin() || auth()->user()->isSupervisor())
            <div class="col-md-12">
                @component('Template::components.table-box')
                    @slot('title', trans('employees.actions.list'))

                    <thead>
                    <tr>
                        <th>@lang('employees.attributes.name')</th>
                        <th class="d-none d-md-table-cell">@lang('employees.attributes.email')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($user->employees as $employee)
                        <tr>
                            <td>
                                <a href="{{ route('dashboard.users.show', $employee) }}"
                                   class="text-decoration-none text-ellipsis">
                            <span class="index-flag">
                            @include('dashboard.users.partials.flags.svg')
                            </span>
                                    <img src="{{ $employee->getAvatar() }}"
                                         alt="{{ $employee->name }}"
                                         class="img-circle img-size-32 mr-2">
                                    {{ $employee->name }}
                                </a>
                            </td>
                            <td class="d-none d-md-table-cell">
                                {{ $employee->email }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="100" class="text-center">@lang($resource.'.empty')</td>
                        </tr>
                    @endforelse
                @endcomponent
            </div>
            @endif
            @if(auth()->user()->isAdmin())
            <div class="col-md-12">
                @include('dashboard.attachments.show')
            </div>
            @endif
        </div>
    </div>
</div>
