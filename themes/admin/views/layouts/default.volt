{% extends 'layouts/base.volt' %}

{% block content %}
<div class="page-main">
    <div class="header py-4">
        <div class="container">
            <div class="d-flex">
                <a class="header-brand" href="/admin">
                    <img src="https://tabler.io/img/tabler.svg" class="header-brand-img" alt="tabler logo">
                </a>

                <div class="d-flex order-lg-2 ml-auto">
                    <div class="dropdown d-none d-md-flex">
                        <a class="nav-link icon" data-toggle="dropdown">
                            <i class="fe fe-bell"></i>
                            <span class="nav-unread"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                            <a href="#" class="dropdown-item d-flex">
                                <span class="avatar mr-3 align-self-center" style="background-image: url(/assets/themes/phlexus-tabler-admin-theme/demo/faces/male/41.jpg)"></span>
                                <div>
                                    <strong>Username1</strong> pushed new commit: Fix page load performance issue.
                                    <div class="small text-muted">10 minutes ago</div>
                                </div>
                            </a>
                            <a href="#" class="dropdown-item d-flex">
                                <span class="avatar mr-3 align-self-center" style="background-image: url(/assets/themes/phlexus-tabler-admin-theme/demo/faces/male/1.jpg)"></span>
                                <div>
                                    <strong>Username2</strong> started new task: Tabler UI design.
                                    <div class="small text-muted">1 hour ago</div>
                                </div>
                            </a>
                            <a href="#" class="dropdown-item d-flex">
                                <span class="avatar mr-3 align-self-center" style="background-image: url(/assets/themes/phlexus-tabler-admin-theme/demo/faces/male/18.jpg)"></span>
                                <div>
                                    <strong>Username3</strong> deployed new version of NodeJS REST Api V3
                                    <div class="small text-muted">2 hours ago</div>
                                </div>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item text-center">Mark all as read</a>
                        </div>
                    </div>

                    <div class="dropdown">
                        <a href="#" class="nav-link pr-0 leading-none" data-toggle="dropdown">
                            <span class="avatar" style="background-image: url(/assets/themes/phlexus-tabler-admin-theme/demo/faces/male/9.jpg)"></span>
                            <span class="ml-2 d-none d-lg-block">
                                <span class="text-default">Name Surname</span>
                                <small class="text-muted d-block mt-1">Administrator</small>
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                            <a class="dropdown-item" href="#">
                                <i class="dropdown-icon fe fe-user"></i> Profile
                            </a>
                            <a class="dropdown-item" href="#">
                                <i class="dropdown-icon fe fe-settings"></i> Settings
                            </a>
                            <a class="dropdown-item" href="#">
                                <span class="float-right"><span class="badge badge-primary">6</span></span>
                                <i class="dropdown-icon fe fe-mail"></i> Inbox
                            </a>
                            <a class="dropdown-item" href="#">
                                <i class="dropdown-icon fe fe-send"></i> Message
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="/admin/auth/logout">
                                <i class="dropdown-icon fe fe-log-out"></i> Sign out
                            </a>
                        </div>
                    </div>
                </div>

                <a href="#" class="header-toggler d-lg-none ml-3 ml-lg-0" data-toggle="collapse" data-target="#headerMenuCollapse">
                    <span class="header-toggler-icon"></span>
                </a>
            </div>
        </div>
    </div>

    <div class="header collapse d-lg-flex p-0" id="headerMenuCollapse">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-3 ml-auto">
                    <form class="input-icon my-3 my-lg-0">
                        <input type="search" class="form-control header-search" placeholder="Search&hellip;" tabindex="1">
                        <div class="input-icon-addon">
                            <i class="fe fe-search"></i>
                        </div>
                    </form>
                </div>

                <div class="col-lg order-lg-first">
                    <ul class="nav nav-tabs border-0 flex-column flex-lg-row">
                        <li class="nav-item">
                            <a href="/admin" class="nav-link active"><i class="fe fe-home"></i> Home</a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/users" class="nav-link"><i class="fe fe-users"></i> Users</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="my-3 my-md-5">
        {% if pageTitle is defined %}
            <div class="container">
                <div class="page-header">
                    <h1 class="page-title">{{ pageTitle }}</h1>
                </div>
            </div>
        {% endif %}

        {{ content() }}
    </div>
</div>

<div class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="row">
                    <div class="col-6 col-md-3">
                        <ul class="list-unstyled mb-0">
                            <li><a href="/admin">Home</a></li>
                            <li><a href="#">Second link</a></li>
                        </ul>
                    </div>
                    <div class="col-6 col-md-3">
                        <ul class="list-unstyled mb-0">
                            <li><a href="#">Third link</a></li>
                            <li><a href="#">Fourth link</a></li>
                        </ul>
                    </div>
                    <div class="col-6 col-md-3">
                        <ul class="list-unstyled mb-0">
                            <li><a href="#">Fifth link</a></li>
                            <li><a href="#">Sixth link</a></li>
                        </ul>
                    </div>
                    <div class="col-6 col-md-3">
                        <ul class="list-unstyled mb-0">
                            <li><a href="#">Other link</a></li>
                            <li><a href="#">Last link</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mt-4 mt-lg-0">
                Premium and Open Source dashboard template with responsive and high quality UI. For Free!
            </div>
        </div>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <div class="row align-items-center flex-row-reverse">
            <div class="col-auto ml-lg-auto">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <ul class="list-inline list-inline-dots mb-0">
                            <li class="list-inline-item"><a href="https://github.com/phlexus">Documentation</a></li>
                            <li class="list-inline-item"><a href="https://github.com/phlexus">FAQ</a></li>
                        </ul>
                    </div>
                    <div class="col-auto">
                        <a href="https://github.com/phlexus" class="btn btn-outline-primary btn-sm">Source code</a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-auto mt-3 mt-lg-0 text-center">
                Copyright © 2019 All rights reserved. Theme <a href="https://tabler.io/">Tabler</a>
            </div>
        </div>
    </div>
</footer>
{% endblock %}
