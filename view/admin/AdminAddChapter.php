<script src="https://cdn.tiny.cloud/1/x1gxlo0zn49s1wa8ut51y8fmidquabypfokkmpvttygcy82n/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

    <script>
    tinymce.init({
        selector: '#mytextarea'
    });
</script>

<h3 class="addChapterTitle">Ajouter un billet</h3>
    
<div>
    <form enctype="multipart/form-data" method="post" action="index.php?action=afficherAdminChapter&addChapter" class="addChapter">
        <input id="auteur" name="auteur" type="hidden" /><br />
        <input id="titre" name="titre" type="text" placeholder="Titre" required /><br />
        <textarea id="mytextarea" name="contenu" required >Hello, World!</textarea>
        <input id="picture" name="picture" type="file" placeholder="picture" /><br />
        <input type="hidden" name="id"/>
        <button type="submit" name="recordChapter" class="addChapterBtn"  value="enregistrer">ENREGISTRER</button>
        <input type="text" name="error" id="message" value="<?php if(isset($message)) {echo $message;} ?>" /><br />
    </form>
    
</div>
