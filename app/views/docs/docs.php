<div class="has-nav">

    <?php require_once('global/nav-docs.php'); ?>

    <div>

        <section id="docs">

            <h2>Requirements</h2>

            <h2 id="what"><a href="#what" aria-label="Why Wayfinder?">¶</a> Why Wayfinder?</h2>

            <aside class="info">
                <p>If you want to understand how <a href="/documentation/routes">routing</a> works in Wayfinder, it can help to look at some <a href="/examples">examples</a> first.</p>
            </aside>

            <p>Wayfinder is primarily a routing system that just happens to be <strong>perfect for rapidly prototyping websites, web apps and APIs</strong>. Your code is neatly organised and with basic MVC principles in mind, you can keep your data models, views and logic all separated.</p>

            <h2 id="start"><a href="#start" aria-label="Link to how to get started">¶</a> Getting started</h2>

            <p>Grab the code from <a href="https://github.com/usewayfinder/Wayfinder">GitHub</a>. Point your host to the <code>www</code> folder and all of your logic lives in the <code>app</code> folder. You'll know it was successful because you'll see this documentation at <code>yourhost.com/documentation</code>.</p>

            <p>The best place to start exploring the code base is the <code>app/conf/routes.php</code> file or the <code>app/controllers</code> folder. When you first install Wayfinder you should see the documentation which is a simple example of how <a href="/documentation/routes#customroutes">custom routes</a> work.</p>

            <p>To start adding your own end points to your website, app or API, read more about <a href="/documentation/routes">routes in Wayfinder</a>.</p>

        </section>

        <section>

            <h2 id="helpers"><a href="#helpers" aria-label="Helpers">¶</a> Helper methods in Wayfinder</h2>

            <p>Wayfinder comes with some methods available instantly in your <a href="/documentation/models">models</a> and <a href="/documentation/controllers">controllers</a>.</p>

            <h3>load($type <em>(models, views, controller, libraries)</em>, $file, $data = [])</h3>

            <p>Use the <code>load()</code> method to load other parts of your application. You can use it to load models and/or views into your controller for example. </p>

            <code>$this->load('views', 'docs');</code>

            <p>Just pass the type of file you're including and the file path + name (without the extension), to automatically include it.</p>

            <details>
                <summary>Show pseudo-code</summary>

                <code><pre>include($type.'/'.$file)</pre></code>
            </details>

            <h3>Passing data to your views</h3>

            <p>When loading a view file, you can pass your data as a third parameter. This should be in an array format which is re-interpreted to expose some variables for use within your templates.</p>

            <code><pre>$data = [
    'title' => 'My Page Title',
    'items' => [
        'first',
        'second',
        'third'
    ]
];

$this->load('views', 'myView', $data);</pre></code>

            <p>This example passes a title and a list of items to the view. The view then has access to the following two variables:</p>

            <code><pre>&lt;?php
echo $title; // My Page Title
var_dump($items); // ['first', 'second', 'third']</pre></code>

            <h3 id="redirect"><a href="#redirect" aria-label="redirect">¶</a> redirect($location, $code = 301)</h3>

            <p>If you need to redirect to a new location, use the <code>redirect()</code> method to take the user there and pass the apprioraite error. Any code after calling <code>redirect()</code> will not be executed. Passing a <a href="https://en.wikipedia.org/wiki/List_of_HTTP_status_codes">HTTP status code</a> is optional, Wayfinder assumes you are performing a permanent redirect.</p>

            <code>$this->redirect('/', 301);</code>

            <details>
                <summary>Show pseudo-code</summary>

                <code><pre>header('Location: '.$location, true, $code)</pre></code>
            </details>

            <p>You can see the <code>redirect()</code> method in action by going to <code><a href="/readdocs">/readdocs</a></code> which will bring you straight back here.</p>

            <h3 id="mimetype"><a href="#mimetype" aria-label="MIME Type">¶</a> MIME Type</h3>

            <p>By adding a file extension to your URL, you can automatically determine the right format for the page. As an example, this page can be requested with the <a href="/documentation.txt">.txt extension</a>.</p>

            <p>By using the <code>$this->getMimeType()</code> method, you can create logic to help you make the right choice.</p>

            <code><pre>if($this->getMimeType() !== 'txt') {
    // your regular display logic
} else {
    // return a plain text file
}</pre></code>

            <p>If no file extension is specified, then every page is treated as HTML but you can explicitly choose from the following list of supported file extensions:</p>

            <ul>
                <li><code>.html</code> <small>(default)</small></li>
                <li><code>.txt</code></li>
                <li><code>.xml</code></li>
                <li><code>.rss</code></li>
                <li><code>.atom</code></li>
                <li><code>.json</code></li>
            </ul>

        </section>

        <section>

            <h2 id="help"><a href="#help" aria-label="Link to help section">¶</a> Need more help?</h2>

            <aside class="info">
                <p>If you need more help with Wayfinder, reach out on <a href="https://twitter.com/usewayfinder" target="_blank">Twitter</a>.</p>
            </aside>

        </section>

    </div>

</div>
