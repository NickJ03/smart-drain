<?php
// connect backend connection.php
$backend = require 'connection.php';

// connect frontend graphs.py
$frontend = shell_exec("streamlit run C:\Users\nickj\PhpstormProjects\smart-drain\wwwroot\graphs.py");

// output frontend to HTML
echo "<pre>$frontend</pre>";
?>