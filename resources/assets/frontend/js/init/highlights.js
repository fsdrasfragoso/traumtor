window.initHighlights = function() {

    let container_div = ".entry-content";
    let selection_id = 0; 
    let select_id;
    let error_select;
    let in_selection = false;
    let stop_prop = false;
    let list_selection_marks = {};
    let selection_info;
    let temp_element;
    let comments = {};
    let is_mobile;
    let url_store;
    let url_page; 
    let url_update;
    let url_delete;

    function ready () {
        /* -- global --
        * ------------------------
        * is_mobile
        * container_div
        * error_select
        * url_store
        * url_page
        * url_update
        * url_delete
        * ----------------------*/

        url_store = $('#url_store').val();
        url_page = $('#url_page').val();
        url_update = $('#url_update').val();
        url_delete = $('#url_delete').val();

        is_mobile = /Android|webOS|iPhone|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);      

        $('body').append("<div class='errorSelect'><i class='fa fa-ban'></i></div>");

        error_select = $('.errorSelect');

        insertMarks();
        
        $('body').on('click', '.tolltipTrue', saveSelectionSetTrue); 
        $('body').on('click', '.save_comment', addComment);
        $('body').on('click', '.tolltipFalse, .close_comment', saveSelectionSetFalse);
        $('body').on('click', '.removeSelection2', removeSelectionFromViewAndBd);
        $('body').on('click', '.elClick', elClick);  // click on selected text
        $('body').on('click', '.tolltipComment', prepareComment);

        $(container_div).on('click touchend', start);

        setTimeout(scrollToSelect, 1000);
    }

    function scrollToSelect()
    {
        let hash = window.location.hash;
        let id_to_scroll;
        let element_to_scroll;

        if(hash) {
            id_to_scroll = hash.replace('#destaque_', '');

            element_to_scroll = document.getElementsByClassName('select-'+id_to_scroll)[0];

            if(!element_to_scroll) return;

            window.scrollTo(0, element_to_scroll.offsetTop - 100);

            setTimeout(function () {
                element_to_scroll.setAttribute('style', 'background-color: #2f2f2f !important; color: white;');
            }, 500)
        }
    }

    function start (e) 
    {
        /* -- global --
        * ------------------------
        * select_id
        * comments
        * stop_prop
        * in_selection
        * selection_info
        * temp_element
        * selection_id
        * ----------------------*/
       
        let tag;
        let text;
        let html;
        let text_index;
        let text_length;
        let tooltip;
        let modal;
        let select_element;
        
        if(e.target.className) {

            modal = $('#text_marker_comment');

            select_element = e.target.className.split('select-');

            if (select_element.length < 2) {

                errorFadeIndicator();
                console.error('Erro!');

            } else {

                select_id = select_element[1].split(' ')[0];

                if(comments['select-' + select_id]) {

                    modal.val(comments['select-' + select_id]);

                } else {
                    
                    modal.val('');

                }
            }
        } else {

            select_id = null;
            
        }

        if((stop_prop || in_selection) && !is_mobile) {

            saveSelectionSetFalse();

        }

        tag = getTextSelected();  

        if(!tag) {
            
            return;

        }

        [text, html,] = tag;
    
        text_index = getTextIndex(text, html);                

        text_length = text.length;

        selection_info = [
            ...tag,
            text_index, 
            text_length, 
            selection_id, 
            false, 
            false
        ];                

        addHighlight(selection_info);

        temp_element = $(".select-" + selection_id);

        if(temp_element.length > 1) {

            temp_element = $(temp_element[0]);

        }

        if(temp_element.length == 0) {

            return;

        }

        tooltip =
            "<div class='tolltip'>"+
                "<a class='tolltipButton tolltipTrue' title='marcar'>"+
                    "<i class='fa fa-paint-brush'></i>"+
                "</a>"+
                "<a class='tolltipButton tolltipComment' title='comentar'>"+
                    "<i class='fa fa-comment'></i>"+
                "</a>"+
            "</div>";

        createTolltip(document.getElementsByClassName("select-" + selection_id)[0], tooltip);

        in_selection = true;

        ++selection_id;
    }

    function insertMarks()
    {
        /* -- global --
        * ------------------------
        * selection_id
        * list_selection_marks
        * url_page
        * ----------------------*/
        
        $.ajax({

            url: url_page,

            success: function(result)
            {                                                
                let marks_list = result.data.resources;
                let popular_list = result.data.popular;
                let test_exclude = {};
                let max = 0;                

                marks_list.forEach(function (marker) {
                
                    let item = [
                        null,null,
                        marker.element_name,
                        marker.element_index,
                        marker.text_index,
                        marker.text_length,
                        marker.id,
                        marker.comment,
                        null,
                    ];

                    test_exclude[marker.text_index + marker.element_name + marker.element_index] = true;

                    list_selection_marks[marker.id] = item;
                    
                    addHighlight(item);

                    if(marker.id > max) {

                        max = marker.id;

                    }
                });

                selection_id = max + 1;
                
                popular_list.forEach(function (popular_marker) {

                    if(test_exclude[popular_marker.text_index + popular_marker.element_name + popular_marker.element_index]) {
                        return;
                    }

                    let item = [
                        null,
                        popular_marker.text_context,
                        popular_marker.element_name,
                        popular_marker.element_index,
                        popular_marker.text_index,
                        popular_marker.text_length,
                        selection_id,
                        popular_marker.comment,
                        true,
                        popular_marker.count
                    ];

                    list_selection_marks[selection_id] = item;

                    addHighlight(item);

                    ++selection_id;
                });
            }
        });
    }

    function prepareComment()
    {
        $('.tolltip').remove();                
        $('#markerModal').modal('show');
    }

    function addComment()
    {
        /* -- global --
        * ------------------------
        * select_id
        * ----------------------*/                

        let commentInput = $('#text_marker_comment');

        let comment = commentInput.val();

        commentInput.val('');

        $('#markerModal').modal('hide');

        if(select_id) {

            saveComment(select_id, comment); 

            return;

        }
                
        saveSelection(true, comment);
    }

    function errorFadeIndicator()
    {
        /* -- global --
        * ------------------------
        * error_select
        * ----------------------*/

        //error_select.css('display', 'block');
        //error_select.fadeOut(1200);
    }

    function getTextSelected ()
    {
        /* -- global --
        * ------------------------
        * container_div
        * ----------------------*/

        let selection;
        let clean_text_selected;

        let start_node;
        let end_node;
        let start_parent_node_name;
        let this_element;

        let end_parent_node_name;
        let parent_node_name;
        let range;

        function isDescendant(parent, child) {

            let node = child.parentNode;

            while (node != null) {

                if (node == parent) {

                    return true;

                }

                node = node.parentNode;
            }

            return false;
        }

        if (!document.createRange) {

            return;

        }

        selection = window.getSelection();

        if (selection.isCollapsed) {

            return; 

        }

        // 1 - Obtém o texto selecionado (limpo, sem HTML).
        clean_text_selected = selection + "";
        // 1.1 Não permite a seleção de enos de duas palavras.
        if(clean_text_selected.length < 2) {

            return;

        }

        // 2 - Obtém o nome e endereço do elemento inicial.
        start_node = selection.anchorNode;
        start_parent_node_name = start_node.parentNode.nodeName;

        // 3 - Obtém o html que envolva os nodes inicial e final.
        end_node = selection.focusNode;
        end_parent_node_name = end_node.parentNode.nodeName;
        range = selection.getRangeAt(0);

        // É o mesmo node ou o node final é um filho: o html pode ser obtido do pai de start_node.
        if(start_node === end_node
            || start_node.parentNode === end_node.parentNode
            || isDescendant(start_node.parentNode, end_node.parentNode)
        ){
            this_element = $(start_node.parentElement);
            parent_node_name = start_parent_node_name;
        }
        // O node inicial é um filho do node final: O html deve ser obtido do node final, que é o pai.
        else if(isDescendant(end_node.parentNode, start_node.parentNode)) {

            this_element = $(end_node.parentElement);
            parent_node_name = end_parent_node_name;

        } else { // Os nodes são primos (possuem um ancestral em comum).

            this_element = $(range.commonAncestorContainer);
            parent_node_name = range.commonAncestorContainer.nodeName;

        }

        return [
            clean_text_selected, 
            this_element.html(), 
            parent_node_name, 
            $(container_div + ' ' + parent_node_name).index(this_element)
        ];
    }

    function getTextIndex(clean_text, html)
    {
        const clean_text_size = clean_text.length;
        const html_aux = html.replace(/&amp;/g, '&');
        let tag_detect_flag = false;
        let counter = 0;
        let i = 0;
        let counter_aux = 0;
        let find = false;

        for (let j = 0; j < html_aux.length; j++) {
            // ------------------------------------- Tag Detector
            if(tag_detect_flag) {
                
                if(html_aux[j] == '>') {
                    tag_detect_flag = false;
                }

                continue;
            }

            if(html_aux[j] == '<') {

                tag_detect_flag = true;

                continue;
            }
            // -------------------------------------------------

            if(html_aux[j] == clean_text[i]) {

                ++i;

                if(clean_text_size == i) {

                    return counter_aux;

                }

                if(!find) {

                    counter_aux = counter;
                    find = true;

                }
            } else {

                i = 0;
                find = false;

            }

            ++counter;
        }

        return counter;
    }

    function addHighlight(item)
    {
        /* -- global --
        * ------------------------
        * container_div
        * comments
        * ----------------------*/

        let tag_detect_flag = false; // flag que marca quando encontramos uma tag dentro da seleção.
        let counter = 0;
        let start_insert_tag = false; // Marca quando inserimos a tag de abertura do highligth.
        let counter_length = 0;
        let tag_count = 0; // verifica se todas as tags abertas dentro da seleção, são fechadas corretamente antes do final da seleção.
        let watch_tag_opened = false; // marca quando existe uma tag de abertura ou fechamento entre os extremos da seleção.
        let marks = []; // quando existe tags "incompletas*" dentro dos limites da seleção, marca aqui os pontos onde devem ser inseridos as novas tags de highligth quebradas.
        // * tags de fechamento sem que se tenha detectado antes a sua respectiva tag de abertura, ou quando existe tags de abertura que não é fechada antes do limite da seleção.
        let element;
        let html;
        let index = 0
        let [
            ,
            ,
            element_name, 
            element_index, 
            text_index, 
            text_length,
            selection_id, 
            comment, 
            who
        ] = item;

        element = $(container_div + ' ' + element_name)[element_index];

        try {

            html = element.innerHTML.replace(/&amp;/g, '&');

        } catch(err) {

            errorFadeIndicator();

            return;

        }

        if(who) {

            who = 'theySelection';

        } else {

            who = 'mySelection';

        }

        if(comment) {

            comments["select-" + selection_id] = comment;

        }

        const span = ["<mark class='" + who + " select-" + selection_id + " elClick' >", "</mark>"];

        for (; index < html.length; index++) {

            // ------------------------------------- Tag Detector
            if(tag_detect_flag) {

                if(html[index] != '>') {

                    continue;

                }

                tag_detect_flag = false;

                ++index;                        
            }

            if(html[index] == '<') {

                if(!watch_tag_opened) {

                    if(start_insert_tag) {

                        marks.push([0, index - 1]);

                    }

                    watch_tag_opened = true;
                }

                tag_detect_flag = true;

                if(start_insert_tag) {

                    if(html[index + 1] != '/') {

                        ++tag_count;

                    } else {

                        --tag_count;

                    }
                }
                
                continue;
            }

            if(watch_tag_opened) {

                if(start_insert_tag) {

                    marks.push([1, index]);

                }

                watch_tag_opened = false;
            }

            if(counter < text_index) {

                ++counter;

                continue;

            }

            if(counter == text_index) {

                html = html.slice(0, index) + span[0] + html.slice(index);

                index += span[0].length;

                start_insert_tag = true;
            }

            if(counter_length == text_length) {

                html = html.slice(0, index) + span[1] + html.slice(index);

                if(tag_count != 0) {

                    for(let index_2 = marks.length - 1; index_2 >= 0; index_2--) {

                        let span_select = span[1];
                        
                        if(marks[index_2][0] == 1) {

                            span_select = span[0];

                        }

                        html = html.slice(0, marks[index_2][1]) + span_select + html.slice(marks[index_2][1]);
                    }
                }

                element.innerHTML = html;

                return;
            }

            if(start_insert_tag) {
            
                counter_length++;
            
            }

            counter++;
        }

        element.innerHTML = html + span[1];
    }

    function elClick ()
    {                
        /* -- global --
        * ------------------------
        * in_selection
        * stop_prop
        * select_id
        * comments
        * list_selection_marks
        * selection_info
        * ----------------------*/

        let green = '';
        let tooltip;
        let className;
        let this_id;

        if(in_selection || stop_prop) {

            return;

        }

        className = this.className;
        this_id = parseInt(className.split('select-')[1].split(' ')[0]);

        temp_element = $(this);

        if(select_id && comments['select-' + select_id]) {

            green = "style='color:#7fff7f !important;'";

        }                

        if(className.indexOf('they') >= 0) {

            selection_info = list_selection_marks[this_id];

            if(!selection_info[0]) {

                selection_info[0] = $('.select-' + this_id).first().html();
                          
            }

            if(!selection_info) return;
        
            tooltip =
                "<div class='tolltip'>"+
                    "<span>"+selection_info[9]+" leitores destacaram este trecho </span>"+
                    "<a class='tolltipButton tolltipTrue' title='marcar'>"+
                        "<i class='fa fa-paint-brush'></i>"+
                    "</a>"+
                "</div>";
        } else {

            tooltip =
                "<div class='tolltip'>"+
                    "<a class='tolltipButton tolltipComment' title='adicionar/editar comentário' "+green+">"+
                        "<i class='fa fa-comment'></i>"+
                    "</a>"+
                    "<a class='tolltipButton removeSelection2' title='remover marcação'>"+
                        "<i class='fa fa-trash'></i>"+
                    "</a>"+
                "</div>";
        }

        createTolltip(this, tooltip);

        stop_prop = true;
    }

    function createTolltip(element, html)
    {
        const w = element.offsetWidth;
        const h = element.offsetHeight;
        const pos = getOffsetTop(element);
        let tolltip;
        let width_tooltip;

        $('body').append(html);

        tolltip = $('.tolltip');

        if(!is_mobile) {

            width_tooltip = tolltip[0].offsetWidth;

            tolltip.css('left', (pos[1] + w/2 - width_tooltip/2)+'px');

        }

        tolltip.css('top', (pos[0]-(h+35))+'px');
    }

    function getOffsetTop(elem)
    {
        let offsetTop = 0;
        let offsetLeft = 0;

        do {
            if (!isNaN(elem.offsetTop)) {

                offsetTop += elem.offsetTop;
                offsetLeft += elem.offsetLeft;

            }
        } while(elem = elem.offsetParent);

        return [offsetTop, offsetLeft];
    }

    function saveSelectionSetTrue() { saveSelection(true); }

    function saveSelectionSetFalse() { saveSelection(false); }

    function saveSelection(save, comment)
    {
        /* -- global --
        * ------------------------
        * stop_prop
        * selection_info
        * temp_element
        * in_selection
        * comments 
        * select_id
        * url_store
        * ----------------------*/

        $('.tolltip').remove();

        stop_prop = false;

        if(!save) {

            let send;

            if(selection_info === undefined) {

                send = null;

            } else {

                send = selection_info[6];

            }

            removeSelection(send, true);

        } else {

            if(selection_info.length == 10) { // Possui "trechos mais destacados"

                temp_element.removeClass('theySelection');
                temp_element.addClass('mySelection');

            }

            selection_info[7] = comment;               
            /*
            data_to_save:
            -------------------------------------------------
            0: *text_selected* Texto selecionado;
            1: *text_context* Contexto do texto selecionado;
            2: *element_name* Elemento HTML que contém o texto selecionado;
            3: *element_index* Index do Elemento 
            4: *text_index* Indice do texto selecionado (início)
            5: *text_length* Tamanho do texto selecionada (lenght)
            6: Não utilizado aqui!
            7: *comment* comentário
            8: null - Não utilizado aqui.
            */
            
            in_selection = false;                     
                            
            $.ajax({
                url: url_store,
                type: "POST",
                data: {
                    "text_selected": selection_info[0],
                    "text_context": selection_info[1].replace(/<[^>]+>/g, ''),
                    "element_name": selection_info[2],
                    "element_index": selection_info[3],
                    "text_index": selection_info[4],
                    "text_length": selection_info[5],
                    "comment": selection_info[7],
                    "footballer_id": $("#footballer_id").val(),
                    "content_id": $("#content_id").val(),
                    "_token": $("input[name='_token']").val(),
                },
                success: function(result) 
                {
                    let element;

                    if(result.error) {

                        console.error(result.error);
                        errorFadeIndicator();
                        removeSelection(selection_id-1, true);

                        return;
                    }
                    
                    if(comment && result.success) {

                        comments['select-' + result.data.id] = comment;

                    }

                    element = $(temp_element[0]);

                    element.removeClass('select-' + selection_info[6]);
                    element.addClass('select-'+result.data.id);

                    selection_info[6] = parseInt(result.data.id);
                },
                error: function (error)
                {
                    console.error('ERROR:', error);
                    
                    errorFadeIndicator();
                    removeSelection(selection_id-1, true);
                }
            });
        }
    }

    function saveComment(selected_id, comment)
    {
        /* -- global --
        * ------------------------
        * stop_prop
        * in_selection
        * url_update
        * ----------------------*/

        stop_prop = false;
        in_selection = false;
        
        $('.tolltip').remove();
    
        $.ajax({
            url: url_update.replace('replace', selected_id),
            type: "PUT",
            data: {
                "_token": $("input[name='_token']").val(),
                "comment": comment
            },
            success: function(result)
            {
                if(result.error) {
                    errorFadeIndicator();
                } else {
                    comments['select-' + selected_id] = comment;
                }
            },
            error: function (error)
            {
                errorFadeIndicator();
                console.error(error);
                
            }
        });
    }

    function removeSelectionFromView() {
        /* -- global --
        * ------------------------
        * stop_prop
        * in_selection
        * ----------------------*/

        stop_prop = false;
        in_selection = false;

        $('.tolltip').remove();
    } 

    function removeSelectionFromViewAndBd() {
    
        removeSelection(); 
    }  

    function removeSelection(remove_by_id, just_selected)
    {
        /* -- global --
        * ------------------------
        * temp_element
        * url_delete
        * ----------------------*/

        removeSelectionFromView();

        if(remove_by_id === undefined) {

            remove_by_id = temp_element[0].className.split('select-')[1].split(' ')[0];
        }

        $.each($(".select-" + remove_by_id), function (index, this_element) {

            this_element.outerHTML = this_element.innerHTML;

        });

        if(just_selected) {
            
            return;

        }
        
        $.ajax({
            url: url_delete.replace('replace', remove_by_id),
            type: "DELETE",
            data: {
                "_token": $("input[name='_token']").val(),
            },
            error: function (error)
            {
                errorFadeIndicator();
                console.error(error);
            }
        });
    }

    ready();
};