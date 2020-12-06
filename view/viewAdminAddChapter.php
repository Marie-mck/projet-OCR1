    <script src="https://cdn.tiny.cloud/1/x1gxlo0zn49s1wa8ut51y8fmidquabypfokkmpvttygcy82n/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

        <script>
        tinymce.init({
            selector: '#mytextarea'
        });
        </script>
    
    <h2>Ajouter un chapitre</h2>
    <div>
        <form method="post" action="" class="addChapter">
            <input id="auteur" name="auteur" type="text" placeholder="Auteur" required /><br />
            <input id="titre" name="titre" type="text" placeholder="Titre" required /><br />
            <textarea id="mytextarea" name="contenu" required >Hello, World!</textarea>
            <input type="submit"name="recordChapter" value="recordChapter" class="addChapterBtn"/>
        </form>
    </div>