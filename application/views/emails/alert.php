<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <title>National Water Supply and Sanitation Council</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>
    <body style="font-family: 'Open Sans', 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 0.9em;">
        <div>
            <p>Dear <?= $recipient->last_name.' '.$recipient->first_name; ?>,</p>

            <p width="40%" style="text-wrap: normal">
                This email is to bring to your attention to the following issues that you have
                to resolve by visiting the <a href="<?= base_url(); ?>">NWASCO dashboard</a>;
            </p>

            <?php if (count($admin_requests) > 0): ?>
                <h4>Administrator Level Requests</h4>

                <table width="40%" style="border: 1px solid black;">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Requested by</th>
                        <th>Type</th>
                        <th>Date</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $x = 1;
                    foreach ($admin_requests as $request): ?>
                        <tr>
                            <td><?= $x; ?></td>
                            <td><?= $request->getUser()->last_name . ' ' . $request->getUser()->first_name; ?></td>
                            <td><?= $request->getKind(); ?></td>
                            <td><?= $request->getCreatedAt(); ?></td>
                            <td><?= $request->getStatus(); ?></td>
                        </tr>
                        <?php $x++; endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>

            <?php if (count($requests) > 0): ?>
                <h4>Requests</h4>

                <table width="40%" style="border: 1px solid black;">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Requested by</th>
                            <th>Type</th>
                            <th>Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $x=1; foreach ($requests as $request): ?>
                        <tr>
                            <td><?= $x; ?></td>
                            <td><?= $request->getUser()->last_name.' '.$request->getUser()->first_name; ?></td>
                            <td><?= $request->getKind(); ?></td>
                            <td><?= $request->getCreatedAt(); ?></td>
                            <td><?= $request->getStatus(); ?></td>
                        </tr>
                    <?php $x++; endforeach;?>
                    </tbody>
                </table>
            <?php endif; ?>

            <?php if ($this->email_manager->hasData($utility_instructions)): ?>
                <h4>Commercial Utility Summary</h4>
                <?php foreach ($utility_instructions as $utility_name => $indicators): ?>
                    <?php if(count($indicators) > 0):?>
                        <h5><?= $utility_name; ?></h5>
                        <table width="40%" style="border: 1px solid black;">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Indicator Name</th>
                                <th>Almost Due</th>
                                <th>Overdue</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $x=1; foreach ($indicators as $indicator_name => $summary): ?>
                                <?php if ($summary[0]['ALMOST'] > 0 || $summary[0]['OVERDUE'] > 0): ?>
                                    <tr>
                                        <td><?= $x; ?></td>
                                        <td><?= $indicator_name; ?></td>
                                        <td style="text-align: center"><?= $summary[0]['ALMOST']; ?></td>
                                        <td style="text-align: center"><?= $summary[0]['OVERDUE']; ?></td>
                                    </tr>
                                <?php endif; ?>
                            <?php $x++; endforeach; ?>
                            </tbody>
                        </table>
                    <?php endif; ?>
                <?php endforeach;?>
            <?php endif; ?>

            <?php if ($this->email_manager->hasData($scheme_instructions)): ?>
                <h4>Private Scheme Summary</h4>
                <?php foreach ($scheme_instructions as $scheme_name => $indicators): ?>
                    <?php if(count($indicators) > 0):?>
                        <h5><?= $scheme_name; ?></h5>
                        <table width="40%" style="border: 1px solid black;">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Indicator Name</th>
                                <th>Almost Due</th>
                                <th>Overdue</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $x=1; foreach ($indicators as $indicator_name => $summary): ?>
                                <?php if ($summary[0]['ALMOST'] > 0 || $summary[0]['OVERDUE'] > 0): ?>
                                    <tr>
                                        <td><?= $x; ?></td>
                                        <td><?= $indicator_name; ?></td>
                                        <td style="text-align: center"><?= $summary[0]['ALMOST']; ?></td>
                                        <td style="text-align: center"><?= $summary[0]['OVERDUE']; ?></td>
                                    </tr>
                                <?php endif; ?>
                            <?php $x++; endforeach; ?>
                            </tbody>
                        </table>
                    <?php endif; ?>
                <?php endforeach;?>
            <?php endif; ?>
            <br/>

            <p>
                Regards, <br/>
                NWASCO Team <br/>
                <img src="<?= base_url().'assets/images/logo.jpg'?>" width="133"/>
            </p>
        </div>
    </body>
</html>