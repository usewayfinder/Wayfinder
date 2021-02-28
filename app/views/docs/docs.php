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

            <p>Read more about <a href="/documentation/routes">routes in Wayfinder</a>.</p>
            
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
