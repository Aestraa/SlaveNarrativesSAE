

<div class="container"><br>
<?php $session = \Config\Services::session(); ?>
<p style="text-align:center"> 
<?= lang('recits.page_title') ?></p><br>
<?php if (! empty($recits) && is_array($recits)): ?>
    <table id="exa" class="display" style="width:100%">
    <thead>
        
    <TR>
		<TH> <?= lang('recits.name_slave') ?> </TH>
        <TH> <?= lang('recits.date_publication') ?> </TH>
        <TH> <?= lang('recits.title') ?> </TH>
        <?php if ($session->get('is_admin')) : ?>
            <TH> <?= lang('recits.modification') ?> </TH>
            <TH> <?= lang('recits.delete') ?> </TH>
        <?php endif; ?>
	</TR>

</thead>
<tbody>
    <?php foreach ($recits as $r): ?>
  
<tr>

    <td>
        <p><a href="<?= site_url()."recits/".esc($r['id_recit'], 'url') ?>"><?php echo $r['nom_esc'];?></a></p>
    </td>

    <td>
        <p><?php echo $r['date_publi'];?></p>
    </td>

    <td>
        <p><?php echo $r['titre'];?></p>
    </td>

        <?php if ($session->get('is_admin')) : ?>
            <td>
                <p><a href="<?= site_url('/modif_recit?esc='.esc($r['id_auteur']).'&idR='.esc($r['id_recit'])) ?>"><?= lang('recits.modify_button') ?></a></p>
             </td>

            <td>
                <p><a href="<?= site_url('Suppr/SupprRecit?esc='.esc($r['id_auteur']).'&idR='.esc($r['id_recit'])) ?>" onclick="return confirm('<?= lang('recits.delete_confirmation') ?>')"><?= lang('recits.delete_button') ?></a></p>
            </td>
        <?php endif; ?>

</tr>

    <?php endforeach ?>
    </tbody>
    </table>
    
    <script>

        $(document).ready(function () {
    $('#exa').DataTable();
});

    </script>

    <?php else: ?>

<h3>No News</h3>
<p>Unable to find any news for you.</p>

<?php endif ?>

<br><br><br>






    </div>

