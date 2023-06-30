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
    "../../controllers/usuario.controllers.php?op=todos",{},(listausuario) => {
      //console.log(JSON.parse(listausuario));
      listausuario = JSON.parse(listausuario);
      $.each(listausuario, (index, usuario) => {
        html +=
          `<tr>` +
          `<td>${index + 1}</td>` +
          `<td>${usuario.nombre}</td>` +
          `<td>${usuario.apellido}</td>` +
          `<td>${usuario.cedula}</td>` +
          `<td>${usuario.correo}</td>` +
         // `<td>${usuario.contrasena}</td>` +
          `<td>${usuario.tipo_rol}</td>` +
          `<td>` +
          `<button class='btn btn-success' onclick='uno(${usuario.id})'>Editar</button>` +
          `<button class='btn btn-danger' onclick='eliminar(${usuario.id})'>Eliminar</button>` +
          `</td>` +
          `</tr>`;
      });
      $('#TUsuario').html(html);
    }
  );
};

var cargaRol= () => {
  var html = ' <option value="0">Seleccione una Opcion</option>';
  $.post("../../controllers/roles.controller.php?op=todos", (listaroles) => {
    listaroles = JSON.parse(listaroles);
    $.each(listaroles, (index, rol) => {
      html += `<option value="${rol.id_rol}">${rol.tipo_rol}</option>`;
    });
    $("#id_rol").html(html);
  });
};

var UsuariosGD = (e) => {
    e.preventDefault();
  var url = "";
  var id = document.getElementById("id").value;
  if ( id === undefined || id === "") {
    url = "../../controllers/usuario.controllers.php?op=insertar";
  } else {
    url = "../../controllers/usuario.controllers.php?op=actualizar";
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
        Swal.fire('Categoria de Usuario', 'Se guardo con exito', 'success');
        limpiar();
        tablacliente();
      } else {
        Swal.fire('Categoria de Usuario', 'Ocurrio un error', 'danger');
      }
    },
  });
};

var uno = (id) => {
  $.post('../../controllers/usuario.controllers.php?op=uno', {
    id: id
  }, (res) => {
      res= JSON.parse(res);
      $('#id').val(res.id);
      $('#cedula').val(res.cedula);
      $('#nombre').val(res.nombre);
      $('#apellido').val(res.apellido);
      $('#correo').val(res.correo);
      $('#contrasena').val(res.contrasena);

  })
  document.getElementById('titulousuario').innerHTML = "Editar Usuarios";
  $('#ModalUsu').modal('show');
};


var eliminar = (id) => {
  Swal.fire({
      title: 'Usuario',
      text: "Esta seguro que desea eliminar...???",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#3085d6',
      confirmButtonText: 'Eliminar!!!'
  }).then((result) => {
      if (result.isConfirmed) {
          $.post('../../controllers/usuario.controllers.php?op=eliminar', {
            id: id
          }, (res) => {
              res = JSON.parse(res);
              if (res === 'ok') {
                  Swal.fire('Usuario', 'Se eliminó con éxito', 'success');
                  limpiar();
                  UsuariosTabla();
              }

          })
      }
  })
};

var limpiar = () => { 
      $('#id').val('');
      $('#nombre').val('');
      $('#apellido').val('');
      $('#cedula').val('');
      $('#correo').val('');
      $('#contrasena').val('');
      $('#id_rol').val('0');
    $('#ModalUsu').modal('hide');
    document.getElementById('titulousuario').innerHTML = "Nuevo Usuario";
};
init();