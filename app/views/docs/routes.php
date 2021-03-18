<div class="has-nav">

    <?php require_once('global/nav-docs.php'); ?>

    <div>

        <section id="docs">

            <h2 id="how"><a href="#how" aria-label="Link to how Wayfinder works">¶</a> How Wayfinder interprets URLs</h2>

            <p>Wayfinder takes the URL and routes it to interpret your code. While <a href="#customroutes">custom routes</a> take priority if defined, it will assume that this is the format is being used: <code>yourhost.com/Controller/method/parameters</code>.</p>

            <h3 id="defaultroute"><a href="#defaultroute" aria-label="Link to the default route">¶</a> The default route</h3>

            <p>There is one exception, which is the root of your domain or project at <code>/</code>. You <em>have</em> to specify what it should point to in the <code>/app/config/routes.php</code> file. Here's the default configuration.</p>

            <code><pre>$_routes = [
    '/' => [
        'controller' => 'documentation',
        'method' => 'home'
    ]
}</pre></code>

            <details>
                <summary>Show pseudo-code</summary>

                <code><pre>&lt;?php
$wf = new Documentation;
$wf->home();</pre></code>
            </details>

            <p>This URL is a <a href="#customroutes">custom route</a>. Out of the box, it points to the <code>Documentation</code> Class and calls the <code>home()</code> method. If no method is specified, Wayfinder assumes you want to use the <code>index()</code> method in your Class.</p>

            <h3 id="classonly"><a href="#classonly" aria-label="Link to how to work with classes">¶</a> Class only</h3>

            <p>You can access your Class and the default <code>index()</code> method by passing just the Class' name through the URL.</p>

            <code>
            /<span title="class">user</span>
            </code>

            <details>
                <summary>Show pseudo-code</summary>

                <code><pre>&lt;?php
    $wf = new User;
    $wf->index();</pre></code>
            </details>

            <aside>
                <p>It is possible to set a <a href="#customroutes">custom route</a> which has the same path as a Class, but not recommended. The custom route will take priority and in some cases <strong>it can make your methods innaccessible</strong>.</p>
            </aside>

            <h3 id="classmethod"><a href="#classmethod" aria-label="Link to how classes and methods work">¶</a> Class and method</h3>

            <p>If you want to call a specific method, just append that to the URL.</p>

            <code>
                /<span title="class">user</span>/<span title="method">profile</span>
            </code>

            <details>
                <summary>Show pseudo-code</summary>

                <code><pre>&lt;?php
    $wf = new User;
    $wf->profile();</pre></code>
            </details>

            <h3 id="classmethodparam"><a href="#classmethodparam" aria-label="Link to how to work with classes, methods and parameters">¶</a> Class, method and parameters</h3>

            <p>For parameters, you can append those too, separated by slashes:</p>

            <code>
            /<span title="class">user</span>/<span title="method">profile</span>/<span title="parameters">cafu</span>
            </code>

            <details>
                <summary>Show pseudo-code</summary>

                <code><pre>&lt;?php
    $wf = new User;
    $wf->profile('cafu');</pre></code>
            </details>

            <p><code>cafu</code> would be the paramater passed to your method. In the following example, you would get two variables, one with the value <code>cafu</code> and another with the value <code>achievements</code>:</p>

            <code>
            /<span title="class">user</span>/<span title="method">profile</span>/<span title="parameters">cafu/achievements</span>
            </code>

            <details>
                <summary>Show pseudo-code</summary>

                <code><pre>&lt;?php
    $wf = new User;
    $wf->profile('cafu', 'achievements');</pre></code>
            </details>

        </section>

        <section>

            <h2 id="customroutes"><a href="#customroutes" aria-label="Link to custom routes">¶</a> Custom routes</h2>

            <p>Taking advantage of the routing mechanism helps to keep your URLs clean. One example of this is where you don't want to reveal the Class or method name.<p>

            <h3 id="simpleroute"><a href="#simpleroute" aria-label="Link to how a simple route works">¶</a> Simple route</h3>

            <code>
            /<span title="class">foo</span>
            </code>

            <p>This can be routed directly to a specific Class, which will use the <code>index()</code> method by default.</p>

            <code><pre>$_route = [
    '/foo' => [
        'controller' => 'Bar'
    ]
];</pre></code>

            <details>
                <summary>Show pseudo-code</summary>

                <code><pre>&lt;?php
    $wf = new Bar;
    $wf->index();</pre></code>
            </details>

            <h3 id="classmethodroutes"><a href="#classmethodroutes" aria-label="Link to how class-method routes work">¶</a> Class and method routes</h3>

            <p>This can be routed directly to a specific Class <em>and</em> method. In this case, it will call <code>$bar->myFunc()</code>.</p>

            <code><pre>$_route = [
    '/foo' => [
        'controller' => 'Bar',
        'method' => 'myFunc'
    ]
];</pre></code>

            <details>
                <summary>Show pseudo-code</summary>

                <code><pre>&lt;?php
    $wf = new Bar;
    $wf->myFunc();</pre></code>
            </details>

            <h3 id="complexroutes"><a href="#complexroutes" aria-label="Link to working with more complex routes">¶</a> More complex route</h3>

            <code>
            <span title="route">/foo/bar/bar/foo</span>
            </code>

            <p>You can either use routing in Wayfinder to take complex URLs and simplify the logic or you can use it to take a simple URL and call something more complex behind the scenes. Let's look at what this 'complex' URL could be doing behind the scenes.</p>

            <code><pre>$_route = [
    '/foo/bar/bar/foo' => [
        'controller' => 'Bar',
        'method' => 'myFunc'
    ]
];</pre></code>

            <details>
                <summary>Show pseudo-code</summary>

                <code><pre>&lt;?php
    $wf = new Bar;
    $wf->myFunc();</pre></code>
            </details>

        </section>

        <section>

            <h2 id="advancedroutes"><a href="#advancedroutes" aria-label="Link to advanced custom routes">¶</a> Advanced custom routes</h2>

            <p>All of the different types of routes can do more than just call the right Class and method. You can predefine parameters or pass them in through the URL. In fact, you can do both at the same time.</p>

            <h3 id="passingparams"><a href="#passingparams" aria-label="Link to how to pass parameters">¶</a> Passing parameters to custom routes</h3>

            <p>Just like the default <a href="#classmethodparam">Class, method, param</a> routes, you can also pass parameters to your route as part of the URL for custom routes too.</p>

            <code>
                <span title="route">/mycustomroute</span>/<span title="parameters">myparam</span>
            </code>

            <code><pre>$_route = [
    '/mycustomroute' => [
        'controller' => 'Bar',
        'method' => 'myFunc'
    ]
];</pre></code>

            <details>
                <summary>Show pseudo-code</summary>

                <code><pre>&lt;?php
    $wf = new Bar;
    $wf->myFunc('myparam');</pre></code>
            </details>

            <p>In the example above, the route would call the <code>myFunc()</code> method from the <code>Bar</code> Class while passing <code>myparam</code> as a parameter.</p>

            <h3 id="predefinedparams"><a href="#predefinedparams" aria-label="Link to how to predefine parameters">¶</a> Routes with predefined parameters</h3>

            <p>You can predefine parameters as part of your route.</p>

            <code>
            <span title="route">/mycustomroute</span>
            </code>

            <p>It appears the route above would only call the Class and method, but in fact it's being routed to call them <em>and</em> to pass two predefined parameters.</p>

            <code><pre>$_route = [
    '/mycustomroute' => [
        'controller' => 'Bar',
        'method' => 'myFunc',
        'params' => [
            'parameter 1',
            'parameter 2'
        ]
    ]
];</pre></code>

            <details>
                <summary>Show pseudo-code</summary>

                <code><pre>&lt;?php
    $wf = new Bar;
    $wf->myFunc('parameter 1', 'parameter 2');</pre></code>
            </details>

            <h3 id="combiningparams"><a href="#combiningparams" aria-label="Link to combining parameters">¶</a> Combining parameters</h3>

            <p>Taking the two previous examples, you can bring them together so that you can pass predefined parameters <em>and</em> accept parameters passed through the URL.</p>

            <code>
                <span title="route">/mycustomroute</span>/<span title="parameters">myparam</span>
            </code>

            <p>You get access to the predefined parameters first, followed by the parameters passed through the URL.</p>

            <code><pre>array(4) {
    [0]=>
    string(11) "parameter 1"
    [1]=>
    string(11) "parameter 2"
    [2]=>
    string(12) "myfirstparam"
    [3]=>
    string(13) "mysecondparam"
}</pre></code>

            <details>
                <summary>Show pseudo-code</summary>

                <code><pre>&lt;?php
    $wf = new Bar;
    $wf->myFunc('parameter 1', 'parameter 2', 'myfirstparam', 'mysecondparam');</pre></code>
            </details>

            <aside>
                <p>This can become confusing from a code management point of view, but it is possible and supported.</p>
            </aside>

            <h3 id="numberedmethodsinroutes"><a href="#numberedmethodsinroutes" aria-label="Link to numbered methods in routes">¶</a> Numbered methods in routes</h3>

            <p>While the controller has to be defined when matching route is found, you can optionally set the method param to reference the position in the URL to use instead.</p>

            <code><pre>$_route = [
    '/mycustomroute' => [
        'controller' => 'Bar',
        'method' => 3
    ]
];</pre></code>

            <p>The above configuration would pick the third item in the URL that follows the matching route. The URL below would call a Class called <code>Bar</code> and a method called <code>thirdparam</code>. The method name is dropped from the URL and everything else is treated as a parameter.</p>

            <code>
                <span title="route">/mycustomroute</span>/<span title="parameters">firstparam/secondparam</span>/<span title="method">thirdparam</span>
            </code>

            <p>This is an extreme example of how you can make routes work for your app, but it becomes useful when you want a route to map to a Class and want to call it's methods without having to define a route for each of them.</p>

            <h3 id="catchall"><a href="#catchall" aria-label="Link to catch all routes">¶</a> Catch all routes</h3>

            <p>Wayfinder can optionally map the first param as a user generated path (think <code>/username</code>) when no route or controller matches. You need to change the <code>__CATCH_FIRST_PARAM</code> setting in the <code>conf.php</code> file to <code>true</code>.</p>

            <p>If your path was <code>/username</code>, this can be interpreted as <code>/defaultRouteController/defaultRouteMethod/username</code>. As with all custom routes, you can predefine paramters in <code>routes.php</code> and you can pass additional parameters in the URL. If additional paramaters are not allowed or you wish to throw an error in certain scenarios (no matching record), then this must be handled by the application logic. Please read the documentation for on <a href="/documentation/errors">errors in Wayfinder</a>.</p>

        </section>

        <section>

            <h2 id="aware"><a href="#aware" aria-label="Link to things to be aware of">¶</a> Things to be aware of</h2>

            <p>In Wayfinder, prefixing a method with an underscore indicates that it is <code>private</code> and available only to the Class they are defined in.</p>

            <p>Wayfinder does what it can to find a matching route. Once a matching route is found that provides a Class and a method, any additional characters are treated as parameters.</p>

            <aside>
                <p>This can cause situations where you think a route should return a 404 but it doesn't. As describe above, this is Wayfinder intentionally treating the additional characters as parameters.</p>
            </aside>

            <h3 id="duplicates"><a href="#duplicates" aria-label="Duplicate content">¶</a> Duplicate content</h3>

            <p>Adding more parameters to a URL can create duplicate content if not handled correctly.</p>

            <p>Either this can be dealt with in the controller's logic or your markup can use the <code>rel="canonical"</code> attribute to help search engines find the right content.</p>

            <h3 id="querystrings"><a href="#querystrings" aria-label="Query Strings">¶</a> Query strings</h3>

            <p>Query strings can be used for things like cache breaking if required (for things like CDNs), but they are ignored by Wayfinder's internal routing.</p>

            <h3 id="errors"><a href="#errors" aria-label="Error messages">¶</a> Error messages</h3>

            <p>If a matching Class, method or route can't be found, a 404 page will be returned. These pages use the default layout and styling as the docs pages but you can change this in the <code>_displayError</code> method found in the <code>app/controllers/Error.php</code> file.</p>

        </section>

    </div>

</div>
