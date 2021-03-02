<div class="has-nav">

    <?php require_once('global/nav-docs.php'); ?>

    <div>

        <section>

            <p>Wayfinder can work through a Command Line Interface, just head to the <code>www</code> folder and execute your commands from there. Thanks to a symlink included in the project, you can invoke <code>Wayfinder</code> from the command line like this:</p>

            <code>php Wayfinder</code>

            <aside>
                <p>If symlinks are not available on your OS, then head to the same directory and use <code>php index.php</code> instead.</p>
            </aside>

            <p>Just like the browser, the CLI will default to using the <code>/</code> route or you can specify your own by passing a URI as an argument:</p>

            <code>php Wayfinder /user/profile/cafu</code>

            <p><a href="/documentation/routes">Routes</a> are Wayfinder is handled the same way by both browsers and the CLI.</p> 

        </section>

    </div>

</div>
