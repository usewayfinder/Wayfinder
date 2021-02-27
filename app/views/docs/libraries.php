<div class="has-nav">

    <?php require_once('global/nav-docs.php'); ?>

    <div>

        <section>

            <p>If you already have some code wrapped as a Class, you can include it as a library in Wayfinder. Just drop it into the <code>app/libraries</code> folder. The <a href="/documentation/database"><code>Db</code> library</a> is shipped by default and is a good example of how this functionality works..</p>

            <code><pre>class Shop extends Wayfinder {

    public function __construct() {
        $this->load('libraries', 'mylib');
        $this->myLib = new myLib();
    }

}</pre></code>

        </section>

    </div>

</div>
