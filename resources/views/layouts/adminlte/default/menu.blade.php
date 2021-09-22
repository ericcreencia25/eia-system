<!-- Sidebar Menu -->
<ul class="sidebar-menu" data-widget="tree">
    {{-- <li class="header">HEADER</li>
    <!-- Optionally, you can add icons to the links -->
    <li class="active"><a href="#"><i class="fa fa-link"></i> <span>Link</span></a></li>
    <li><a href="#"><i class="fa fa-link"></i> <span>Another Link</span></a></li>
    <li class="treeview">
        <a href="#"><i class="fa fa-link"></i> <span>Multilevel</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="#">Link in level 2</a></li>
            <li><a href="#">Link in level 2</a></li>
        </ul>
    </li> --}}
    @if (Auth::user()->Employee)
    @canany(['view-employee', 'view-applicant'])
    <li class="header">USERS</li>
    @can('view-employee')
    <li @if ("/" . request()->path() == route('employees',[],false)) class="active" @endif><a
            href="{{ route('employees') }}"><i class="fa fa-users"></i> <span>Employees</span></a></li>
    @endcan
    @can('view-applicant')
    <li @if ("/" . request()->path() == route('applicants',[],false)) class="active" @endif><a
            href="{{ route('applicants') }}"><i class="fa fa-users"></i> <span>Applicants</span></a></li>
    @endcan
    @endcanany
    @can('view-log')
    <li class="header">SYSTEM</li>
    <li @if ("/" . request()->path() == route('logs',[],false)) class="active" @endif><a href="{{ route('logs') }}"><i
                class="fa fa-book"></i> <span>Logs</span></a></li>
    <li @if ("/" . request()->path() == route('sections',[],false)) class="active" @endif><a href="{{ route('sections') }}"><i
                class="fa fa-chevron-circle-right"></i> <span>Workflow Section</span></a></li>
    <li @if ("/" . request()->path() == route('unitadmins',[],false)) class="active" @endif><a href="{{ route('unitadmins') }}"><i
        class="fa fa-users"></i> <span>Application Unit Admin</span></a></li>
    <li @if ("/" . request()->path() == route('inspection.unitadmins',[],false)) class="active" @endif><a href="{{ route('inspection.unitadmins') }}"><i
        class="fa fa-users"></i> <span>Inspection Unit Admin</span></a></li>
    <li @if ("/" . request()->path() == route('worklist',[],false)) class="active" @endif><a href="{{ route('worklist') }}"><i
        class="fa fa-cog"></i> <span>Manage Worklist</span></a></li>
    <li @if ("/" . request()->path() == route('workflow_autoforward',[],false)) class="active" @endif><a href="{{ route('workflow_autoforward') }}"><i
        class="fa fa-cog"></i> <span>Manage Auto Forward</span></a></li>
    <li @if ("/" . request()->path() == route('attachmenttypes',[],false)) class="active" @endif><a href="{{ route('attachmenttypes') }}"><i
        class="fa fa-book"></i> <span>Manage Attachment Types</span></a></li>
    <li @if ("/" . request()->path() == route('evaluationitems',[],false)) class="active" @endif><a href="{{ route('evaluationitems') }}"><i
        class="fa fa-check"></i> <span>Manage Evaluation Items</span></a></li>
    <li @if ("/" . request()->path() == route('regions',[],false)) class="active" @endif><a href="{{ route('regions') }}"><i
        class="fa fa-map"></i> <span>Manage Regions</span></a></li>
    <li @if ("/" . request()->path() == route('holidays',[],false)) class="active" @endif><a href="{{ route('holidays') }}"><i
        class="fa fa-calendar-minus-o"></i> <span>Manage Holidays</span></a></li>
    @endcan
    @can('employee-process-application')
    <li class="header">APPLICATIONS</li>
    @can(['view-log'])
    <li @if ("/" . request()->path() == route('certificatelist', [], false)) class="active" @endif><a href="{{ route('certificatelist') }}"><i class="fa fa-file-pdf-o"></i> <span> Certificates</span></a></li>
    @endcan
    <li @if ("/" . request()->path() == route('all-applications', [], false)) class="active" @endif><a href="{{ route('all-applications') }}"><i class="fa fa-book"></i> <span> All Applications</span></a></li>
    
    <li @if ("/" . request()->path() == route('all-ptts', [], false)) class="active" @endif><a href="{{ route('all-ptts') }}"><i class="fa fa-file-text-o"></i> <span> All Permit to Transports</span></a></li>
    @can('is-EMED-or-is-CPD-or-in-CEN')
    <li @if ("/" . request()->path() == route('tp-tr-inspection', [], false)) class="active" @endif><a href="{{ route('tp-tr-inspection') }}"><i class="fa fa-file-text-o"></i> <span> All TP / TSD Inspection Status</span></a></li>
    @endcan
    <li @if ("/" . request()->path() == route('processed-applications', [], false)) class="active" @endif><a href="{{ route('processed-applications') }}"><i class="fa fa-check-square-o"></i> <span> Processed Applications</span></a></li>
    <li @if ("/" . request()->path() == route('for-action-applications', [], false)) class="active" @endif><a href="{{ route('for-action-applications') }}"><i class="fa fa-pencil-square-o"></i> <span> For Action</span></a></li>
    @endcan
    <li class="header">REPORTS</li>
    <li @if ("/" . request()->path() == route('report.generator', [], false)) class="active" @endif><a href="{{ route('report.generator') }}"><i class="fa fa-list"></i> <span> Registered HW Generators</span></a></li>
    <li @if ("/" . request()->path() == route('report.generator.summary', [], false)) class="active" @endif><a href="{{ route('report.generator.summary') }}"><i class="fa fa-list"></i> <span> HW Generators Summary</span></a></li>
    <li @if ("/" . request()->path() == route('report.generator.distribution', [], false)) class="active" @endif><a href="{{ route('report.generator.distribution') }}"><i class="fa fa-list"></i> <span> HW Generators Distribution</span></a></li>
    <li @if ("/" . request()->path() == route('report.ptt', [], false)) class="active" @endif><a href="{{ route('report.ptt') }}"><i class="fa fa-list"></i> <span> Permit to Transport Summary</span></a></li>
    <li @if ("/" . request()->path() == route('report.manifest', [], false)) class="active" @endif><a href="{{ route('report.manifest') }}"><i class="fa fa-list"></i> <span> PTT, Manifest, COT Summary</span></a></li>
    <li @if ("/" . request()->path() == route('report.treater', [], false)) class="active" @endif><a href="{{ route('report.treater') }}"><i class="fa fa-list"></i> <span> Registered TSD Facilities</span></a></li>
    <li @if ("/" . request()->path() == route('report.treater.summary', [], false)) class="active" @endif><a href="{{ route('report.treater.summary') }}"><i class="fa fa-list"></i> <span> TSD Facilities Summary</span></a></li>
    <li @if ("/" . request()->path() == route('report.transporter', [], false)) class="active" @endif><a href="{{ route('report.transporter') }}"><i class="fa fa-list"></i> <span> Registered HW Transporters</span></a></li>
    <li @if ("/" . request()->path() == route('report.transporter.vehicles', [], false)) class="active" @endif><a href="{{ route('report.transporter.vehicles') }}"><i class="fa fa-list"></i> <span> Registered HW Transporters <br> With Registered Vehicles Information</span></a></li>
    <li @if ("/" . request()->path() == route('report.transporter.summary', [], false)) class="active" @endif><a href="{{ route('report.transporter.summary') }}"><i class="fa fa-list"></i> <span> HW Transporters Summary</span></a></li>
    <li @if ("/" . request()->path() == route('report.inventory', [], false)) class="active" @endif><a href="{{ route('report.inventory') }}"><i class="fa fa-list"></i> <span> HW Inventory per HW Generator</span></a></li>
    <!-- <li @if ("/" . request()->path() == route('report.transporter', [], false)) class="active" @endif><a href="{{ route('report.transporter') }}"><i class="fa fa-list"></i> <span> Registered HW Transporters</span></a></li> -->
    <li class="header">Tutorials</li>
    <li><a target="_blank" href="https://emb.gov.ph/wp-content/uploads/2020/05/Processing-an-Application-Process-EMB-Staff.pdf"><i class="fa fa-question-circle"></i> <span> Employee Guides</span></a></li>
    @else
    <li class="header">My Account</li>
    <li @if ("/" . request()->path() == route('applications', [], false)) class="active" @endif><a
            href="{{ route('applications') }}"><i class="fa fa-archive"></i> <span>Applications</span></a></li>
    <li class="header">Permitting</li>
    <li class="treeview">
        <a href="#"><i class="fa fa-refresh"></i> <span>Generator</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="{{ route('application.generator.registration.all') }}">Applications</a></li>
            <li @if (strpos("/" . request()->path(), '/generator/permit-to-transport') !== false)
                class="active" @endif><a href="{{ route('application.permit-to-transport.create') }}">PTT Form</a></li>
            <li @if (strpos("/" . request()->path(), '/generator/manifest') !== false)
                class="active" @endif><a href="{{ route('application.permit-to-transport.all') }}">Manifest</a></li>
            <li @if (strpos("/" . request()->path(), '/generator/inventory') !== false)
            class="active" @endif><a href="{{ route('application.generator.inventory') }}">HW Inventory</a></li>

        </ul>
    </li>
    <li class="treeview">
        <a href="#"><i class="fa fa-truck"></i> <span>Transporter</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="{{ route('application.transporter.registration.all') }}">Applications</a></li>
            <li><a href="{{ route('application.transporter.manifest.all') }}">Manifest</a></li>
        </ul>
    </li>
    <li class="treeview">
        <a href="#"><i class="fa fa-bath"></i> <span>TSD Facility</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="{{ route('application.treater.registration.all') }}">Applications</a></li>
            <li><a href="{{ route('applciation.treater.manifest.all') }}">Manifest</a></li>
        </ul>
    </li>
    <li class="header">Tutorials</li>
    <li @if ("/" . request()->path() == route('guides', [], false)) class="active" @endif><a target="_blank" href="{{ route('guides') }}"><i class="fa fa-question-circle"></i> <span> Guides and Tutorials</span></a></li>
    @endif
</ul>
<!-- /.sidebar-menu -->
