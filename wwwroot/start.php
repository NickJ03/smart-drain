<?php

/* Author: Nick Jans
Copyright (c) 2023 - Eindhoven University of Technology, The Netherlands
This software is made available under the terms of the GNU General Public License v3.0. */

// connect backend connection.php
$backend = require 'connection.php';

// connect frontend graphs.py
$frontend = shell_exec("streamlit run --global.developmentMode=false C:\Users\\nickj\PhpstormProjects\smart-drain\wwwroot\graphs.py");

// output frontend to HTML
echo "<pre>$frontend</pre>";
?>