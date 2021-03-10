<div class="has-nav">

    <?php require_once('global/nav-docs.php'); ?>

    <div>

        <section>

            <p>Controllers should contain the logic for your website, app or API. Controllers bringing the data from your models together and then pass them on to your views.</p>

            <h2 id="anatomy"><a href="#anatomy" aria-label="Anatomy of a controller">¶</a> Anatomy of a controller</h2>

            <p>A controller should extend the Wayfinder Class so that you have access to all of it's public methods, like so:</p>

            <code><pre>class MyClass extends Wayfinder {

}</pre></code>

            <h3 id="construct"><a href="#construct" aria-label="__construct()">¶</a> __construct()</h3>

            <p>Within your class, you can optionally use the <code>__construct()</code> method to automatically run some tasks when the Class is first initiated.</p>

            <code><pre>class MyController extends Wayfinder {

    function __construct() {
        // do stuff here
    }

}</pre></code>

            <h3 id="endpoints"><a href="#endpoints" aria-label="Creating an end point">¶</a> Creating an end point</h3>

            <p>To create an end point in Wayfinder, just declare a public method. If no method is specified in the URL or in your custom route, then Wayfinder will look for <code>index()</code> by default.</p>

            <code><pre>class MyController extends Wayfinder {

    public function index() {
        // default page
    }

    public function myendpoint() {
        // a custom endpoint
    }

}</pre></code>

            <p>The definition above would give you three end point:</p>

            <ol>
                <li><code>/mycontroller</code></li>
                <li><code>/mycontroller/index</code> (same as above)</li>
                <li><code>/mycontroller/myendpoint</code></li>
            </ol>

            <h3 id="publicprivate"><a href="#publicprivate" aria-label="Public and private methods">¶</a> Public and private methods</h3>

            <p>Public methods expose end points, where as private methods can be used to hide functionality and are great at helping you to organise your code.</p>

            <?php require_once('global/public-private.php'); ?>

        </section>

    </div>

</div>
