$(document).ready(function(){

    const editor = new EditorJS({
        holder: 'editorjs',
        tools:{
            header:Header,
            delimiter: Delimiter,
            paragraph: {
             class: Paragraph,
             inlineToolbar: true,
           },
           embed: Embed,
           image: SimpleImage,
        }
    });

    $("#save").click(function(){
        editor.save().then((output) => {
            console.log('Data: ', output);
        }).catch((error) => {
            console.log('Saving failed: ', error)
        });
    })
})