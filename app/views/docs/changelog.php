
<section>

    <h2 id="releases">Releases</h2>

    <?php $format = 'jS M Y'; ?>

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
            <li>File-based caching</li>
            <li>Sitemap generator</li>
        </ul>

    </div>

</section>

<section>

    <h2 id="contribute">Contribute to Wayfinder</h2>

    <p>Don't see the feature you need? You can submit a <a href="https://github.com/cchana/Wayfinder">pull-request</a> or submit your suggestions on <a href="https://twitter.com/wayfinder">Twitter</a>.</p>

</section>
