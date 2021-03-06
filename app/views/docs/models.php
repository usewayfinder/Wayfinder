<div class="has-nav">

    <?php require_once('global/nav-docs.php'); ?>

    <div>

        <section>

            <p>Use models to manage your data, <a href="/documentation/controllers">controllers</a> can pass the right data to them so that your model can create, read, update or delete items.</p>

            <h2 id="anatomy"><a href="#anatomy" aria-label="Link to anatomy of a model">¶</a> Anatomy of a model</h2>

            <p>A model should extend the Wayfinder Class so that you have access to all of it's public methods, like so:</p>

            <code><pre>class MyModel extends Wayfinder {

}</pre></code>

            <h3 id="construct"><a href="#construct" aria-label="Link to the __construct method">¶</a> __construct()</h3>

            <p>Within your class, you can optionally use the <code>__construct()</code> method to automatically run some tasks when the Class is first initiated.</p>

            <code><pre>class MyModel extends Wayfidner {

    function __construct() {
        // do stuff here
    }

}</pre></code>

            <h3 id="demo"><a href="#demo" aria-label="Demo model">¶</a> Demo model</h3>

            <p>As part of the documentation, an example model is included with the project. You can see the output at <code><a href="/documentation/models/demo-users">/documentation/models/demo-users</a></code>.</p>

            <p>The model is a simplified example of how you can load and manipulate data to pass back to your controller. Look for the <code>models()</code> method in the Documentation controller to see how the model is loaded and used.</p>

            <h3>Public and private methods</h3>

            <p>Public methods in a model are used to expose functionality to <a href="/documentation/controllers">controllers</a> in Wayfinder. Private methods are more like helpers, and can help you to better organise your code.</p>

            <?php require_once('global/public-private.php'); ?>

        </section>

    </div>

</div>
