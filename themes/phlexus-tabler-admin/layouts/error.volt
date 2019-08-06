{% extends $defaultBaseLayout %}

<div class="page-content">
    <div class="container text-center">
        <div class="display-1 text-muted mb-5"><i class="si si-exclamation"></i> {{ title }}</div>

        <h1 class="h2 mb-3">Oops.. You just found an error page..</h1>
        <p class="h4 text-muted font-weight-normal mb-7">{{ description }}&hellip;</p>

        <a class="btn btn-primary" href="javascript:history.back()">
            <i class="fe fe-arrow-left mr-2"></i>Go back
        </a>
    </div>
</div>
