$(function () {


	$(document).on('click', '.toolbar__nav__item', function () {
		$('body').css('overflow', 'auto');
	});


	var toggleSidebar = ($sidebar, all = false) => {

		if($sidebar.hasClass('is-active')) {
			var $sidebarSub = $sidebar.find('.sidebar__sub.is-active');
			if($sidebarSub.length) {

				hideSidebarSub($sidebarSub);

				if(all) {
					hideSidebar($sidebar);
				}
			} else {
				hideSidebar($sidebar);
			}
		} else {
			showSidebar($sidebar);
		}
	};
	$('.category-toggle').each(function(i,el) {
		console.log(`el.id `,el.id)
		let idDrop = el.id.split('category-drop-')[1]
		console.log(`idDrop`, idDrop)
		let idDropItemEl = $('#' + 'category-' + idDrop);
		$('#' + el.id).click( function (){
			// idDropItemEl.toggle(200);
			if($('#' + el.id).hasClass('cat-is-active')){
				idDropItemEl.hide(200);
				$('#' + el.id).removeClass('cat-is-active');
			}
			else {
				idDropItemEl.show(200);
				$('#' + el.id).addClass('cat-is-active');
			}
			
		})
	})

	$('.on-blur, .outset, .gopath').on('click', function(){
		$('.on-blur').addClass('d-none');
	})

	$('.drop-head').on('click', function(){
		if ($(this).parent().hasClass('show')) {
		    $('.on-blur').addClass('d-none');
		} else {
		    $('.on-blur').removeClass('d-none');
		}
	})
	
	$('.opensub').on('click', function (e) {
		e.stopPropagation();

		if ($($(this).data("target")).hasClass('d-none')) {
				$('.dropdown-subcategory').addClass('d-none');
				$($(this).data("target")).removeClass('d-none');
				$('.opensub').find('i').removeClass('fa-angle-down').addClass('fa-angle-right');
				$(this).find('i').removeClass('fa-angle-right').addClass('fa-angle-down');
		} else {
				$($(this).data("target")).addClass('d-none');
				$('.opensub').find('i').removeClass('fa-angle-down').addClass('fa-angle-right');
		}
	});

	var showSidebar = ($sidebar) => {

		var $header_container = $('#header .header__container');
		var $button = $('[data-toggle="sidebar"][data-sidebar="#'+$sidebar.attr('id')+'"]');

		$header_container.css('top', '0px');
		$sidebar.addClass('is-active');
		$button.addClass('is-active');

		$('#main').addClass('sidebar-open');
		$('body').css('overflow', 'hidden');

		$("[title='Mensagem da empresa']").fadeOut(0);
		$("[title='Botão para abrir a janela de mensagens']").fadeOut(0);
		$("[title='Número de mensagens não lidas']").fadeOut(0);
	};

	var hideSidebar = ($sidebar) => {

		var $button = $('[data-toggle="sidebar"][data-sidebar="#'+$sidebar.attr('id')+'"]');

		$sidebar.removeClass('is-active');
		$button.removeClass('is-active');

		$('#main').removeClass('sidebar-open');
        $('body').css('overflow', 'scroll');

		$("[title='Mensagem da empresa']").fadeIn(0);
		$("[title='Botão para abrir a janela de mensagens']").fadeIn(0);
		$("[title='Número de mensagens não lidas']").fadeIn(0);
	};

	var toggleSidebarSub = ($sidebarSub) => {

		if($sidebarSub.hasClass('is-active')) {
			hideSidebarSub($sidebarSub);
		} else {
			showSidebarSub($sidebarSub);
		}

	};

	var showSidebarSub = ($sidebarSub) =>  {
		var $sidebar = $sidebarSub.closest('.sidebar');
		var $button = $('[data-toggle="sidebar"][data-sidebar="#'+$sidebar.attr('id')+'"]');

		$sidebarSub.addClass('is-active');
		$button.removeClass('hamburger--collapse');
		$button.addClass('hamburger--arrow');
	};

	var hideSidebarSub = ($sidebarSub) => {
		var $sidebar = $sidebarSub.closest('.sidebar');
		var $button = $('[data-toggle="sidebar"][data-sidebar="#'+$sidebar.attr('id')+'"]');

		$sidebarSub.removeClass('is-active');
		$button.addClass('hamburger--collapse');
		$button.removeClass('hamburger--arrow');
	};

	/* Sidebar toggle behaviour */
	$(document).on('click', '[data-toggle="sidebar"]', (e) => {
		e.preventDefault();
		var $sidebar = $($(e.currentTarget).data('sidebar'));
		var $active = $('.sidebar.is-active');
		if($active.attr('id') != $sidebar.attr('id')) {
			toggleSidebar($active, true);
		}

		toggleSidebar($sidebar);
	});

	$(document).on('click', '.toolbar-item', (e) => {
		hideSidebar($('#sidebar-menu'));
	})

	/* Sidebar sub toggle behaviour */
	$(document).on('click', '[data-toggle="sidebar-sub"]', (e) => {
		e.preventDefault();
		var $sidebarSub = $($(e.currentTarget).data('sidebar-sub'));
		toggleSidebarSub($sidebarSub);
	});

	/* Drop sidebar */
	$(document).on('click', '.sidebar .sidebar__drop', (e) => {
		var $sidebar = $(e.currentTarget).closest('.sidebar');
		toggleSidebar($sidebar, true);
	});

	/* close sidebar on pjax */
	$(document).on('click', '.sidebar a[data-pjax]', (e) => {
		var $sidebar = $(e.currentTarget).closest('.sidebar');
		toggleSidebar($sidebar, true);
	});

	$(document).on('submit', '.sidebar form[data-pjax]', (e) => {
		var $sidebar = $(e.currentTarget).closest('.sidebar');
		toggleSidebar($sidebar, true);
	});

	$(document).on('show.bs.dropdown', '#header .dropdown', (e) => {
		var $active = $('.sidebar.is-active');
		if($active.length) {
			toggleSidebar($active, true);
		}
	});

});
