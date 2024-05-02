
<section>

    <h2 id="releases">Releases</h2>

    <aside class="info">
        <p>Wayfinder is under active and continious development and every effort is made to avoid introducing breaking changes.</p>
    </aside>

    <?php $format = 'jS M Y'; ?>

    <h3><a href="https://github.com/usewayfinder/Wayfinder/releases/tag/0.13">v0.13</a> <small><?php echo date($format, strtotime('2nd May 2024')); ?></small></h4>

    <div class="inset">
        <ul>
            <li class="new">PHP 8 updates for the <a href="/documentation/database">database library</a></li>
        </ul>
    </div>

    <h3><a href="https://github.com/usewayfinder/Wayfinder/releases/tag/0.12">v0.12</a> <small><?php echo date($format, strtotime('21st March 2021')); ?></small></h4>

    <div class="inset">
        <ul>
            <li class="new"><a href="/documentation/config">Config file</a> expanded to bring maintenance and production mode flags to Wayfinder</li>
        </ul>
    </div>

    <h3><a href="https://github.com/usewayfinder/Wayfinder/releases/tag/0.11">v0.11</a> <small><?php echo date($format, strtotime('18th March 2021')); ?></small></h4>

    <div class="inset">
        <ul>
            <li class="new">Introducing <a href="/documentation/routes#catchall">catch all routes</a> to Wayfinder</li>
        </ul>
    </div>

    <h3><a href="https://github.com/usewayfinder/Wayfinder/releases/tag/0.10">v0.10</a> <small><?php echo date($format, strtotime('15th March 2021')); ?></small></h4>

    <div class="inset">
        <ul>
            <li>Wayfinder has been rewritten and now handles scenarios more gracefully</li>
            <li>Wayfinder no longer requires the logic to be triggered by the <code>__construct()</code> method, is now specifically called by the <code>init()</code> method</li>
            <li>Introducing more detailed unit tests for the Wayfinder framework</li>
        </ul>
    </div>

    <h3><a href="https://github.com/usewayfinder/Wayfinder/releases/tag/0.9">v0.9</a> <small><?php echo date($format, strtotime('12th March 2021')); ?></small></h4>

    <div class="inset">
        <ul>
            <li class="new">Paramaters specified as part of a route were not passed always passed to the controller</li>
            <li>Routes now reference <code>method</code> instead of <code>function</code></li>
        </ul>
    </div>

    <h3><a href="https://github.com/usewayfinder/Wayfinder/releases/tag/0.8">v0.8</a> <small><?php echo date($format, strtotime('9th March 2021')); ?></small></h4>

    <div class="inset">
        <ul>
            <li class="new">Ability to specify <a href="/documentation/routes#numberedmethodsinroutes">the numerical position of the method name in your custom routes</a></li>
        </ul>
    </div>

    <h3><a href="https://github.com/usewayfinder/Wayfinder/releases/tag/0.7">v0.7</a> <small><?php echo date($format, strtotime('7th March 2021')); ?></small></h4>

    <div class="inset">
        <ul>
            <li class="new">You can specify the <a href="/documentation#mimetype">MIME type</a> of a page by suffixing one of the supported file extensions to your URL
                <ul>
                    <li><code>.html</code> <small>(default)</small></li>
                    <li><code>.txt</code></li>
                    <li><code>.xml</code></li>
                    <li><code>.rss</code></li>
                    <li><code>.atom</code></li>
                    <li><code>.json</code></li>
                </ul>
            </li>
        </ul>
    </div>

    <h3><a href="https://github.com/usewayfinder/Wayfinder/releases/tag/0.6">v0.6</a> <small><?php echo date($format, strtotime('5th March 2021')); ?></small></h4>

    <div class="inset">
        <ul>
            <li class="new">Create redirects with the <code>redirect()</code> method in Wayfinder</li>
        </ul>
    </div>

    <h3>v0.5 <small><?php echo date($format, strtotime('4th March 2021')); ?></small></h4>

    <div class="inset">
        <ul>
            <li class="new">Introducing a demo <a href="/documentation/models#demo">model</a> and <a href="/documentation/models/demo-users">example documentation</a></li>
        </ul>
    </div>

    <h3>v0.4 <small><?php echo date($format, strtotime('3rd March 2021')); ?></small></h4>

    <div class="inset">
        <ul>
            <li class="new">Dark mode introduced for the <a href="/documentation">documentation</a></li>
            <li>Fixed issue whith the Database library not being able to return data from <code>SELECT</code> queries</li>
            <li>Improved reliability when using PHP's <code>include</code> and <code>require</code> functonality in the Wayfinder framework</li>
            <li>First round of tests included with the project</li>
        </ul>
    </div>

    <h3>v0.3 <small><?php echo date($format, strtotime('1st March 2021')); ?></small></h4>

    <div class="inset">
        <ul>
            <li class="new">Introducing <a href="/documentation/cli">CLI access</a> to Wayfinder</li>
            <li>Updated Wayfinder's <a href="/documentation/errors">error handling</a> logic</li>
            <li>Improved <a href="/documentation">documentation</a></li>
        </ul>
    </div>

    <h3>v0.2 <small><?php echo date($format, strtotime('26th February 2021')); ?></small></h4>

    <div class="inset">
        <ul>
            <li class="new">Introducing <a href="/documentation/libraries">libraries</a></li>
            <li class="new">Added a default <a href="/documentation/database">database</a> library for MySQL</li>
        </ul>
    </div>

    <h3>v0.1 <small><?php echo date($format, strtotime('24th February 2021')); ?></small></h4>

    <div class="inset">
        <ul>
            <li>Initial release</li>
        </ul>

    </div>

</section>

<section>

    <h2 id="roadmap">Roadmap</h2>

    <div class="inset">

        <ul>
            <li>Example model</li>
            <li>File-based caching</li>
            <li>Sitemap generator</li>
        </ul>

    </div>

</section>

<section>

    <h2 id="contribute">Contribute to Wayfinder</h2>

    <p>Don't see the feature you need? You can submit a <a href="https://github.com/usewayfinder/Wayfinder">pull-request</a> or submit your suggestions on <a href="https://twitter.com/wayfinder">Twitter</a>.</p>

</section>
