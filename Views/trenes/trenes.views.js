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
    "../../controllers/trenes.controllers.php?op=todos",{},(listausuario) => {
      //console.log(JSON.parse(listausuario));
      listausuario = JSON.parse(listausuario);
      $.each(listausuario, (index, usuario) => {
        html +=
          `<tr>` +
          //`<td>${index + 1}</td>` +
         `<td>${usuario.ID_tren}</td>` +
          `<td>${usuario.modelo}</td>` +
         // `<td>${usuario.cedula}</td>` +
         //`<td>${usuario.correo}</td>` +
         // `<td>${usuario.contrasena}</td>` +
         // `<td>${usuario.tipo_rol}</td>` +
          `<td>` +
          `<button class='btn btn-success' onclick='uno(${usuario.ID_tren})'>Editar</button>` +
          `<button class='btn btn-danger' onclick='eliminar(${usuario.ID_tren})'>Eliminar</button>` +
          `</td>` +
          `</tr>`;
      });
      $('#TUsuario').html(html);
    }
  );
};
/*
var cargaRol= () => {
  var html = ' <option value="0">Seleccione una Opcion</option>';
  $.post("../../controllers/trenes.controller.php?op=todos", (listaroles) => {
    listaroles = JSON.parse(listaroles);
    $.each(listaroles, (index, rol) => {
      html += `<option value="${rol.id_rol}">${rol.tipo_rol}</option>`;
    });
    $("#id_rol").html(html);
  });
};
*/
var UsuariosGD = (e) => {
    e.preventDefault();
  var url = "";
  var ID_tren = document.getElementById("ID_tren").value;
  if ( ID_tren === undefined || ID_tren === "") {
    url = "../../controllers/trenes.controllers.php?op=insertar";
  } else {
    url = "../../controllers/trenes.controllers.php?op=actualizar";
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
        Swal.fire('Categoria de Tren', 'Se guardo con exito', 'success');
        limpiar();
        UsuariosTabla();
      } else {
        Swal.fire('Categoria de Tren', 'Ocurrio un error', 'danger');
      }
    },
  });
};

var uno = (ID_tren) => {
  $.post('../../controllers/trenes.controllers.php?op=uno', {
    ID_tren:ID_tren
  }, (res) => {
      res= JSON.parse(res);
      $('#ID_tren').val(res.ID_tren);
      $('#modelo').val(res.modelo);
     // $('#nombre').val(res.nombre);
    ///  $('#apellido').val(res.apellido);
     /// $('#correo').val(res.correo);
      //$('#contrasena').val(res.contrasena);

  })
  document.getElementById('titulousuario').innerHTML = "Editar Tren";
  $('#ModalUsu').modal('show');
};


var eliminar = (ID_tren) => {
  Swal.fire({
      title: 'Tren',
      text: "Esta seguro que desea eliminar...???",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#3085d6',
      confirmButtonText: 'Eliminar!!!'
  }).then((result) => {
      if (result.isConfirmed) {
          $.post('../../controllers/trenes.controllers.php?op=eliminar', {
            ID_tren: ID_tren
          }, (res) => {
              res = JSON.parse(res);
              if (res === 'ok') {
                  Swal.fire('Tren', 'Se eliminó con éxito', 'success');
                  limpiar();
                  UsuariosTabla();
              }

          })
      }
  })
};

var limpiar = () => { 
      $('#ID_tren').val('');
      $('#modelo').val('');
   //   $('#apellido').val('');
    ///  $('#cedula').val('');
     // $('#correo').val('');
     // $('#contrasena').val('');
     // $('#id_rol').val('0');
    $('#ModalUsu').modal('hide');
    document.getElementById('titulousuario').innerHTML = "Nuevo Tren";
};
init();