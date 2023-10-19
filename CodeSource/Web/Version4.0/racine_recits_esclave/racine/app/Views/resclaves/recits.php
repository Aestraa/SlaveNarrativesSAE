

<div class="container"><br>
<?php $session = \Config\Services::session(); ?>
<p style="text-align:center"> 
<?= lang('recits.page_title') ?></p><br>


<form action="<?= base_url('recits') ?>" method="get">
    <input class="input-search" type="text" name="search" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>" placeholder=<?= lang('recits.search') ?>>
    <input class="button-search" type="submit" value=<?= lang('recits.search_button') ?>>
</form></br>

<form action="<?= base_url('recits') ?>" method="get">
    <input class="button-tri" type="submit" value="Trier">
    <select class="input-tri" name="tri" id="tri">
    <option value="nomAZ">Trier par nom de A-Z</option>
    <option value="nomZA">Trier par nom de Z-A</option>
    <option value="anneeAZ">Trier par annéee croissante</option>
    <option value="anneeZA">Trier par annéee décroisante</option>
    <option value="titreAZ">Trier par titre de A-Z</option>
    <option value="titreZA">Trier par titre de Z-A</option>
    </select>
</form></br>

<!--
<style>
    .sortable-header {
        position: relative;
    }

    .sortable-header a {
        position: absolute;
        top: 0;
    }

    .arrow-up {
        right: 10px; 
    }

    .arrow-down {
        right: 0;
    }
    
</style>
-->

<?php if (! empty($recits) && is_array($recits)): ?>
    <table id="exa" class="display" style="width:100%; margin-top:1%">
    <thead>
        
    <TR>
            <th style="position: relative;" class="sortable-header">
                <?= lang('recits.name_slave') ?>
                <!--
                <a href="?sort=name_slave_asc" class="arrow-up">&#9650;</a>
                <a href="?sort=name_slave_desc" class="arrow-down">&#9660;</a>
                -->
            </th>
            <th style="position: relative;" class="sortable-header">
                <?= lang('recits.date_publication') ?>
                <!--
                <a href="?sort=date_publication_asc" class="arrow-up">&#9650;</a>
                <a href="?sort=date_publication_desc" class="arrow-down">&#9660;</a>
                -->
            </th>
            <th style="position: relative;" class="sortable-header">
                <?= lang('recits.title') ?>
                <!--
                <a href="?sort=title_desc" class="arrow-down">&#9660;</a>
                <a href="?sort=title_asc" class="arrow-up">&#9650;</a>
                -->
            </th>
        <?php if ($session->get('is_admin')) : ?>
            <TH> <?= lang('recits.modification') ?> </TH>
            <TH> <?= lang('recits.delete') ?> </TH>
        <?php endif; ?>
	</TR>

    </thead>



<tbody>
    <?php if(isset($recitsT) && is_array($recitsT)):
     foreach ($recits as $r): ?>
  
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
    <?php else : ?>
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
    <?php endif; ?>

    <script>

        $(document).ready(function () {
    $('#exa').DataTable();
});

    </script>

    <?php else: ?>

<h3>Pas de récit</h3>
<p>Aucun récit n'a été trouvé</p>

<?php endif ?>

<br><br><br>






    </div>

