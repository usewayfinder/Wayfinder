<h2>URL routing</h2>

<p>Below shows have routing works when you rely on just the URL.</p>

<table>
    <thead>
        <tr>
            <th>Route</th>
            <th>Class</th>
            <th>Method</th>
            <th>Params</th>
            <th>Notes</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><code>/foo</code></td>
            <td><code>Foo</code></td>
            <td><code>index</code></td>
            <td>None</td>
            <td></td>
        </tr>
        <tr>
            <td><code>/foo/bar</code></td>
            <td><code>Foo</code></td>
            <td><code>bar</code></td>
            <td>None</td>
            <td></td>
        </tr>
        <tr>
            <td><code>/foo/bar/foobar</code></td>
            <td><code>Foo</code></td>
            <td><code>bar</code></td>
            <td><code>{
    0 => 'foobar'
}</code></td>
            <td></td>
        </tr>
    </tbody>
</table>

<h2>Custom routing</h2>

<p>Below shows have routing works when you make use of routing.</p>

<table>
    <thead>
        <tr>
            <th>Route</th>
            <th>Class</th>
            <th>Method</th>
            <th>Params</th>
            <th>Notes</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><code>/</code></td>
            <td>Refer to <code>app/conf/routes.php</code></td>
            <td><code>index</code> by default</td>
            <td>None by default</td>
            <td>The method and params can also be specified in the custom routes set for <code>/</code> in <code>app/conf/routes.php</code></td>
        </tr>
    </tbody>
</table>
