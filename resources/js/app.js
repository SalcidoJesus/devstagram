
import Dropzone from "dropzone";

// ignorar id por defecto
Dropzone.autoDiscover = false

const dropzone = new Dropzone('#dropzone', {
	dictDefaultMessage: 'Elige tu imagen',
	acceptedFiles: '.png,.jpg,.jpeg,.gif,.webp',
	addRemoveLinks: true,
	dictRemoveFile: 'Borrar archivo',
	maxFiles: 1,
	uploadMultiple: false,

	init: function() {
		if ( document.querySelector('[name=imagen]').value.trim() ) {
			const imagenPublicada = {
				size: 1234,
				name: document.querySelector('[name=imagen]').value
			}
			this.options.addedfile.call( this, imagenPublicada )
			this.options.thumbnail.call( this, imagenPublicada, `/uploads/${imagenPublicada.name}`)

			imagenPublicada.previewElement.classList.add('dz-success', 'dz-complete')
		}
	}
})

dropzone.on('success', function( file, response ) {
	// console.log( response.imgen );
	document.querySelector('[name=imagen]').value = response.imagen
})

dropzone.on('removedfile', function() {
	document.querySelector('[name=imagen]').value = ''
})
