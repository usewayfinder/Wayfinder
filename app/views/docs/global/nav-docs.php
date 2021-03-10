<nav aria-label="secondary">
    <h3>In this section</h3>
    <ul>
        <li <?php if($_SERVER['REQUEST_URI'] == '/documentation') {echo 'class="active has-children"';} ?>>
            <a href="/documentation">Introduction</a>
            <?php if($_SERVER['REQUEST_URI'] == '/documentation') { ?>
            <ul>
                <li><a href="#what">Why Wayfinder?</a></li>
                <li><a href="#helpers">Helper methods in Wayfinder</a></li>
                <li><a href="#redirect">Redirect</a></li>
                <li><a href="#mimetype">MIME Type</a></li>
                <li><a href="#help">Need more help?</a></li>
            </ul>
            <?php } ?>
        </li>
        <li <?php if($_SERVER['REQUEST_URI'] == '/documentation/routes') {echo 'class="active has-children"';} ?>>
            <a href="/documentation/routes">Routes</a>
            <?php if($_SERVER['REQUEST_URI'] == '/documentation/routes') { ?>
            <ul>
                <li><a href="#how">How Wayfinder interprets URLs</a></li>
                <li><a href="#defaultroute">The default route</a></li>
                <li><a href="#classonly">Class only</a></li>
                <li><a href="#classmethod">Class and method</a></li>
                <li><a href="#classmethodparam">Class, method and parameters</a></li>
                <li><a href="#customroutes">Custom routes</a></li>
                <li><a href="#simpleroute">Simple route</a></li>
                <li><a href="#classmethodroutes">Class and method routes</a></li>
                <li><a href="#complexroutes">More complex route</a></li>
                <li><a href="#advancedroutes">Advanced custom routes</a></li>
                <li><a href="#passingparams">Passing parameters to custom routes</a></li>
                <li><a href="#predefinedparams">Routes with predefined parameters</a></li>
                <li><a href="#combiningparams">Combining parameters</a></li>
                <li><a href="#numberedmethodsinroutes">Numbered methods in routes</a></li>
                <li><a href="#aware">Things to be aware of</a></li>
                <li><a href="#duplicates">Duplicate content</a></li>
                <li><a href="#querystrings">Query strings</a></li>
                <li><a href="#errors">Error messages</a></li>
            </ul>
            <?php } ?>
        </li>
        <li <?php if($_SERVER['REQUEST_URI'] == '/documentation/models') {echo 'class="active has-children"';} ?>>
            <a href="/documentation/models">Models</a>
            <?php if($_SERVER['REQUEST_URI'] == '/documentation/models') { ?>
            <ul>
                <li><a href="#anatomy">Anatomy of a model</a></li>
                <li><a href="#construct">__construct()</a></li>
                <li><a href="#demo">Demo model</a></li>
            </ul>
        <?php } ?>
        </li>
        <li <?php if($_SERVER['REQUEST_URI'] == '/documentation/views') {echo 'class="active"';} ?>>
            <a href="/documentation/views">Views</a>
        </li>
        <li <?php if($_SERVER['REQUEST_URI'] == '/documentation/controllers') {echo 'class="active has-children"';} ?>>
            <a href="/documentation/controllers">Controllers</a>
            <?php if($_SERVER['REQUEST_URI'] == '/documentation/controllers') { ?>
            <ul>
            <ul>
                <li><a href="#anatomy">Anatomy of a controller</a></li>
                <li><a href="#construct">__construct()</a></li>
                <li><a href="#endpoints">Creating an end point</a></li>
                <li><a href="#publicprivate">Public and private methods</a></li>
            </ul>
            </ul>
            <?php } ?>
        </li>
        <li <?php if($_SERVER['REQUEST_URI'] == '/documentation/database') {echo 'class="active has-children"';} ?>>
            <a href="/documentation/database">Database</a>
            <?php if($_SERVER['REQUEST_URI'] == '/documentation/database') { ?>
            <ul>
                <li><a href="#query" aria-label="query()">query()</a></li>
                <li><a href="#escape" aria-label="escape()">escape()</a></li>
                <li><a href="#lastinsertid" aria-label="lastInsertId()">lastInsertId()</a></li>
                <li><a href="#error" aria-label="error()">error()</a></li>
            </ul>
            <?php } ?>
        </li>
        <li <?php if($_SERVER['REQUEST_URI'] == '/documentation/libraries') {echo 'class="active"';} ?>>
            <a href="/documentation/libraries">Libraries</a>
        </li>
        <li <?php if($_SERVER['REQUEST_URI'] == '/documentation/cli') {echo 'class="active"';} ?>>
            <a href="/documentation/cli" title="Command Line Interface">CLI</a>
        </li>
        <li <?php if($_SERVER['REQUEST_URI'] == '/documentation/errors') {echo 'class="active has-children"';} ?>>
            <a href="/documentation/errors">Error handling</a>
            <?php if($_SERVER['REQUEST_URI'] == '/documentation/errors') { ?>
            <ul>
                <li><a href="#supported">Supported Error Codes</a></li>
            </ul>
            <?php } ?>
        </li>
    </ul>
</nav>
