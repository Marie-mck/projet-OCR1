<script src="https://cdn.tiny.cloud/1/x1gxlo0zn49s1wa8ut51y8fmidquabypfokkmpvttygcy82n/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

<script>
        tinymce.init({
        selector: '#mytextarea'
});
</script>

<h3 id="modifChapterTitle"><?php if (isset($_GET['modifierChapterBtn'])) {echo "Modification d'un Billet";} ?></h3>

<p><a href="index.php?action=afficherAdminChapter&id=<?php echo $getChapters->id()?>">← Retour au billet</a></p>

<div>
        <form method="post" action="index.php?action=afficherAdminChapter&modifierNewChapter&id=<?php if (isset($_GET['modifierChapterBtn'])) {echo $getChapters->id();} ?>" class="addChapter">
        
        <input id="titre" name="titre" type="text" value="<?php if (isset($_GET['modifierChapterBtn'])) {echo $getChapters->titre();} ?>" placeholder="Titre" required /><br />
        <textarea id="mytextarea" name="contenu" required >Hello, World! <?php if (isset($_GET['modifierChapterBtn'])) {echo $getChapters->contenu();} ?></textarea>
        
        <button type="submit" name="modifierNewChapter" class="changeChapterBtn"><?php if (isset($_GET['modifierChapterBtn'])) {echo "Modifier";} ?></button>
        </form>
</div>