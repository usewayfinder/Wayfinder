<div class="has-nav">

    <?php require_once('global/nav-docs.php'); ?>

    <div>

        <section>

            <p>While you <a href="/documentation/controllers">controllers</a> contain the logic, your views take the data passed to them and display it in a meaningful way.</p>

            <p>For websites, this might be in HTML and for apps or APIs this could be in XML or JSON.</p>

            <p>Views should be built in a way that works best for you. In the case of Wayfinder's documentation, the header, body and footer of a page are split into three separate blocks. This helps keep the common code reusable and organised.</p>

            <p>All of the views for the Wayfinder documentation can be found in the <code>app/views/docs</code> folder. You'll not only find the front-end logic here, but an example of how you might organise reusable parts of your code. You'll find a <code>global</code> folder that contains a number of reusable blocks that build up the structure of a HTML page.</p>

            <code><pre>$data = [
    'title' => 'Wayfinder'
];

$this->load('views', 'docs/global/header', $data);
$this->load('views', 'docs/index', $data);
$this->load('views', 'docs/global/footer', $data);</pre></code>

            <p>Most of the pages for the documentation in Wayfinder are built up by loading in the header, then the relevant body and finally the footer.</p>

        </section>

    </div>

</div>
