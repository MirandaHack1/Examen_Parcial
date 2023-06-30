//TODO: Archivo de javascript para agregar la funcionalidad a la apgina usuarios.html

function init(){
    $('#usu_form').on('submit', (e)=>{
      UsuariosGD(e);
    })
}


$().ready(() => {
    UsuariosTabla();
});

var UsuariosTabla = () => {
  var html = "";
  $.post(
    "../../controllers/estaciones.controllers.php?op=todos",{},(listausuario) => {
      //console.log(JSON.parse(listausuario));
      listausuario = JSON.parse(listausuario);
      $.each(listausuario, (index, usuario) => {
        html +=
          `<tr>` +
          //`<td>${index + 1}</td>` +
         `<td>${usuario.ID_estacion}</td>` +
          `<td>${usuario.ciudad}</td>` +
         // `<td>${usuario.cedula}</td>` +
         //`<td>${usuario.correo}</td>` +
         // `<td>${usuario.contrasena}</td>` +
         // `<td>${usuario.tipo_rol}</td>` +
          `<td>` +
          `<button class='btn btn-success' onclick='uno(${usuario.ID_estacion})'>Editar</button>` +
          `<button class='btn btn-danger' onclick='eliminar(${usuario.ID_estacion})'>Eliminar</button>` +
          `</td>` +
          `</tr>`;
      });
      $('#TUsuario').html(html);
    }
  );
};

var UsuariosGD = (e) => {
    e.preventDefault();
  var url = "";
  var ID_estacion = document.getElementById("ID_estacion").value;
  if ( ID_estacion === undefined || ID_estacion === "") {
    url = "../../controllers/estaciones.controllers.php?op=insertar";
  } else {
    url = "../../controllers/estaciones.controllers.php?op=actualizar";
  }
  var form_Data = new FormData($("#usu_form")[0]);
  $.ajax({
    url: url,
    type: "POST",
    data: form_Data,
    processData: false,
    contentType: false,
    cache: false,
    success: (respuesta) => {
      respuesta = JSON.parse(respuesta);
      console.log(respuesta);
      if (respuesta == "ok") {
        Swal.fire('Categoria de Ciudad', 'Se guardo con exito', 'success');
        limpiar();
        UsuariosTabla();
      } else {
        Swal.fire('Categoria de Ciudad', 'Ocurrio un error', 'danger');
      }
    },
  });
};

var uno = (ID_estacion) => {
  $.post('../../controllers/estaciones.controllers.php?op=uno', {
    ID_estacion:ID_estacion
  }, (res) => {
      res= JSON.parse(res);
      $('#ID_estacion').val(res.ID_estacion);
      $('#ciudad').val(res.ciudad);
     // $('#nombre').val(res.nombre);
    ///  $('#apellido').val(res.apellido);
     /// $('#correo').val(res.correo);
      //$('#contrasena').val(res.contrasena);

  })
  document.getElementById('titulousuario').innerHTML = "Editar estacion";
  $('#ModalUsu').modal('show');
};


var eliminar = (ID_estacion) => {
  Swal.fire({
      title: 'ciudad',
      text: "Esta seguro que desea eliminar...???",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#3085d6',
      confirmButtonText: 'Eliminar!!!'
  }).then((result) => {
      if (result.isConfirmed) {
          $.post('../../controllers/estaciones.controllers.php?op=eliminar', {
            ID_estacion: ID_estacion
          }, (res) => {
              res = JSON.parse(res);
              if (res === 'ok') {
                  Swal.fire('ciudad', 'Se eliminó con éxito', 'success');
                  limpiar();
                  UsuariosTabla();
              }

          })
      }
  })
};

var limpiar = () => { 
      $('#ID_estacion').val('');
      $('#ciudad').val('');
   //   $('#apellido').val('');
    ///  $('#cedula').val('');
     // $('#correo').val('');
     // $('#contrasena').val('');
     // $('#id_rol').val('0');
    $('#ModalUsu').modal('hide');
    document.getElementById('titulousuario').innerHTML = "Nuevo estacion";
};
init();