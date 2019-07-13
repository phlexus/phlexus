<!doctype html>
<html>
<head>
    <meta charset="UTF-8">

    <title>{{ get_title() }}</title>

    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Source+Sans+Pro:300,300i,400,400i,500,500i,600,600i,700,700i&amp;subset=latin-ext">
    <link rel="stylesheet" href="/assets/themes/phlexus-tabler-admin-theme/css/dashboard.css">
    <link rel="stylesheet" href="/assets/themes/phlexus-tabler-admin-theme/plugins/charts-c3/plugin.css">
    <link rel="stylesheet" href="/assets/themes/phlexus-tabler-admin-theme/plugins/maps-google/plugin.css">

    <script src="/assets/themes/phlexus-tabler-admin-theme/js/require.min.js"></script>
    <script src="/assets/themes/phlexus-tabler-admin-theme/js/require.config.js"></script>
    <script src="/assets/themes/phlexus-tabler-admin-theme/js/dashboard.js"></script>
    <script src="/assets/themes/phlexus-tabler-admin-theme/plugins/charts-c3/plugin.js"></script>
    <script src="/assets/themes/phlexus-tabler-admin-theme/plugins/maps-google/plugin.js"></script>
    <script src="/assets/themes/phlexus-tabler-admin-theme/plugins/input-mask/plugin.js"></script>
    <script src="/assets/themes/phlexus-tabler-admin-theme/plugins/datatables/plugin.js"></script>
</head>

<body>
<div class="page">
    {% block content %}{% endblock %}
</div>

</body>
</html>
