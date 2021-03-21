<div class="has-nav">

    <?php require_once('global/nav-docs.php'); ?>

    <div>

        <section>

            <p>The <code>conf/config.php</code> file contains constants that help you to quickly configure certain aspects of your applciation.</p>

            <table>
                <thead>
                    <tr>
                        <th>Constant</th>
                        <th>Purpose</th>
                        <th>Default</th>
                        <th>Options</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><code>__MAINTENANCE_MODE</code></td>
                        <td>Determine if your app is currently in maintenance mode or not.<br /><br />The file used can be found at <code>www/maintenance.html</code></td>
                        <td><code>false</code></td>
                        <td><code>true</code> or <code>false</code></td>
                    </tr>
                    <tr>
                        <td>__CATCH_FIRST_PARAM</td>
                        <td>Should <a href="/documentation/routes#catchall">catch all</a> mode be enabled.</td>
                        <td><code>false</code></td>
                        <td><code>true</code> or <code>false</code></td>
                    </tr>
                    <tr>
                        <td>__PRODUCTION</td>
                        <td>Is the app being run in production mode?<br /><br />By default it relies on an environment variable called 'environment' to be set to 'production'.<br /><br /><strong>You are free to change the logic.</strong></td>
                        <td>Environment variable</td>
                        <td><code>true</code> or <code>false</code></td>
                    </tr>
                </tnody>
            </table>

        </section>

    </div>

</div>
