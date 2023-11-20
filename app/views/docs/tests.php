<div class="has-nav">

    <?php require_once('global/nav-docs.php'); ?>

    <div>

        <section>

            <p>You can find basic unit tests in the folder <code>tests/unit</code>. There are some base tests for the Wayfinder framework and an example on how to test a controller.</p>

            <h3>Session handling</h3>

            <p>If you need to test a session, it is recommended that you uncomment the 3rd line in <code>tests/bootstrap.php</code> so that <code>session_start()</code> is called first. Subsequent calls to <code>session_start()</code> will be ignored by PHP.</p>

        </section>

    </div>

</div>
