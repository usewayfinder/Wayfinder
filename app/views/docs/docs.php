<div class="has-nav">

    <?php require_once('global/nav-docs.php'); ?>

    <div>

        <section id="docs">

            <aside class="info">
                <p>If you want to understand how routing works in Wayfinder, take a look at some <a href="/examples">examples</a> first.</p>
            </aside>

            <h2 id="what"><a href="#what" aria-label="Link to what Wayfinder is useful for">¶</a> What is Wayfinder useful for?</h2>

            <p>Wayfinder started as a routing system, but it's also perfect for rapid prototyping for websites, web apps and APIs. Your code is neatly organised and with basic MVC principles in mind, you can keep your data models, views and logic all separated.</p>

            <h2 id="start"><a href="#start" aria-label="Link to how to get started">¶</a> Getting started with Wayfinder</h2>

            <p>To get started, take a look at the <code>app/conf/routes.php</code> file and the <code>app/controllers</code> folder. When you first install Wayfinder you should see the documentation which is a simple example of how <a href="#customroutes">custom routes</a> work. If you want to see how to work without custom routes, then you can access this page by going to <code>yourdomain.com/docs/documentation</code>.</p>

            <h2 id="how"><a href="#how" aria-label="Link to how Wayfinder works">¶</a> How Wayfinder interprets URLs</h2>

            <h3 id="defaultroute"><a href="#defaultroute" aria-label="Link to the default route">¶</a> The default route</h3>

            <p>This is the root of your project, you <em>have</em> to specify what it should point to in the <code>/app/config/routes.php</code> file.</p>

            <code>
            /
            </code>

            <p>This URL is a <a href="#customroutes">custom route</a>. Out of the box, it points to the documentation. If no method is specified, it is assumed you want to use the <code>index()</code> method in your Class.</p>

            <p>This pseudo-code describes what's happening:</p>

            <code>
        &lt;php<br />
        $w = new Docs;<br />
        $w->index();<br />
            </code>

            <h3 id="classonly"><a href="#classonly" aria-label="Link to how to work with classes">¶</a> Class only</h3>

            <p>You can access your Class and the default <code>index()</code> method by passing just the Class' name through the URL.</p>

            <code>
            /<span title="class">user</span>
            </code>

            <aside>
                <p>It is possible to set a <a href="#customroutes">custom route</a> which has the same path as a Class, in this case the custom route will have priority.</p>
            </aside>

            <h3 id="classmethod"><a href="#classmethod" aria-label="Link to how classes and methods work">¶</a> Class and method</h3>

            <p>If you want to call a specific method, just append that to the URL:</p>

            <code>
                /<span title="class">user</span>/<span title="method">profile</span>
            </code>

            <h3 id="classmethodparam"><a href="#classmethodparam" aria-label="Link to how to work with classes, methods and parameters">¶</a> Class, method and parameters</h3>

            <p>For parameters, you can append those too, separated by slashes:</p>

            <code>
            /<span title="class">user</span>/<span title="method">profile</span>/<span title="parameters">cafu</span>
            </code>

            <p><code>cafu</code> would be the paramater passed to your method. In the following example, you would get two variables, one with the value <code>cafu</code> and another with the value <code>achievements</code>:</p>

            <code>
            /<span title="class">user</span>/<span title="method">profile</span>/<span title="parameters">cafu/achievements</span>
            </code>

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

            <h3 id="classmethodroutes"><a href="#classmethodroutes" aria-label="Link to how class-method routes work">¶</a> Class and method routes</h3>

            <p>This can be routed directly to a specific Class <em>and</em> function. In this case, it will call <code>$bar->myFunc()</code>.</p>

            <code><pre>$_route = [
    '/foo' => [
        'controller' => 'Bar',
        'function' => 'myFunc'
    ]
];</pre></code>

            <h3 id="complexroutes"><a href="#complexroutes" aria-label="Link to working with more complex routes">¶</a> More complex route</h3>

            <code>
            <span title="route">/foo/bar/bar/foo</span>
            </code>

            <p>You can take a route that appears to be more complex, and use it to call something simpler. In some ways this is almost the exact opposite of what Wayfinder is here for, but it is possible.</p>

            <code><pre>$_route = [
    '/foo/bar/bar/foo' => [
        'controller' => 'Bar',
        'function' => 'myFunc'
    ]
];</pre></code>

        </section>

        <section>

            <h2 id="advancedroutes"><a href="#advancedroutes" aria-label="Link to advanced custom routes">¶</a> Advanced custom routes</h2>

            <h3 id="passingparams"><a href="#passingparams" aria-label="Link to how to pass parameters">¶</a> Passing parameters to custom routes</h3>

            <p>Just like the default <a href="#classmethodparam">Class, method, param</a> routes, you can also pass parameters to your route as part of the URL for custom routes too.</p>

            <code>
                <span title="route">/mycustomroute</span>/<span title="parameters">myparam</span>
            </code>

            <code><pre>$_route = [
    '/mycustomroute' => [
        'controller' => 'Bar',
        'function' => 'myFunc'
    ]
];</pre></code>

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
        'function' => 'myFunc',
        'params' => [
            'parameter 1',
            'parameter 2'
        ]
    ]
];</pre></code>

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

            <aside>
                <p>This can become confusing from a code management point of view, but it is possible and supported.</p>
            </aside>

        </section>

        <section>

            <h2 id="aware"><a href="#aware" aria-label="Link to things to be aware of">¶</a> Things to be aware of</h2>

            <p>Methods prefixed with an underscore are considered to be private and available only to the Class they're defined in.</p>

            <h3>Why Wayfinder?</h3>

            <p><strong>Wayfinder is a tool to help you quickly build projects that require simple routing or for rapid prototyping.</strong></p>

            <p>Wayfinder does what it can to find a matching route. Once a matching route is found that provides a Class and a method, any additional characters are treated as parameters.</p>

            <aside>
                <p>This can cause situations where you think a route should return a 404 but it doesn't. As describe above, this is Wayfinder intentially treating the additional characters as parameters.</p>
            </aside>

            <h3>Duplicate content</h3>

            <p>Adding more parameters to a URL can create duplicate content if not handled correctly.</p>

            <p>Either this can be dealt with in the controller's logic or your markup can use the <code>rel="canonical"</code> attribute to help search engines find the right content.</p>

            <h3>Query strings</h3>

            <p>Query strings can be used for things like cache breaking if required (for things like CDNs), but they are ignored by Wayfinder's internal routing.</p>

            <h3>Error messages</h3>

            <p>If a matching Class, method or route can't be found, a 404 page will be returned. These pages use the default layout and styling as the docs pages but you can change this in the <code>_displayError</code> method found in the <code>app/controllers/Error.php</code> file.</p>

        </section>

        <section>

            <h2 id="help"><a href="#help" aria-label="Link to help section">¶</a> Need help?</h2>

            <aside class="info">
                <p>If you need help with Wayfinder, get in touch on <a href="https://twitter.com/cchana">Twitter</a>.</p>
            </aside>

        </section>

    </div>

</div>
