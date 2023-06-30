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
    "../../controllers/rutas.controllers.php?op=todos",{},(listausuario) => {
      //console.log(JSON.parse(listausuario));
      listausuario = JSON.parse(listausuario);
      $.each(listausuario, (index, usuario) => {
        html +=
          `<tr>` +
         `<td>${index + 1}</td>` +
        
          `<td>${usuario.modelo}</td>` +
          `<td>${usuario.ciudad}</td>` +
          `<td>${usuario.ID_estacion_destino}</td>` +
          `<td>${usuario.ID_fecha}</td>` +
         // `<td>${usuario.contrasena}</td>` +
         // `<td>${usuario.tipo_rol}</td>` +
          `<td>` +
          `<button class='btn btn-success' onclick='uno(${usuario.ID_rutas})'>Editar</button>` +
          `<button class='btn btn-danger' onclick='eliminar(${usuario.ID_rutas})'>Eliminar</button>` +
          `</td>` +
          `</tr>`;
      });
      $('#TUsuario').html(html);
    }
  );
};

var cargaVariable = () => {
  var htmlModeloTren = '<option value="0">Seleccione una Opción</option>';
  var htmlCiudadEstacion = '<option value="0">Seleccione una Opción</option>';
  
  $.post("../../controllers/trenes.controllers.php?op=todos", (lista) => {
    lista = JSON.parse(lista);
    $.each(lista, (index, ID_tren) => {
      htmlModeloTren += `<option value="${ID_tren.ID_tren}">${ID_tren.modelo}</option>`;
    });
    $("#ID_tren").html(htmlModeloTren);
  });

  // Cargar datos desde el archivo estaciones.controllers.php
  $.post("../../controllers/estaciones.controllers.php?op=todos", (lista) => {
    lista = JSON.parse(lista);
    $.each(lista, (index, estaciones) => {
      htmlCiudadEstacion += `<option value="${estaciones.ID_estacion}">${estaciones.ciudad}</option>`;
    });
    $("#ID_estacion_origen").html(htmlCiudadEstacion);
  });
};

var UsuariosGD = (e) => {
    e.preventDefault();
  var url = "";
  var ID_rutas= document.getElementById("ID_rutas").value;
  if ( ID_rutas === undefined || ID_rutas === "") {
    url = "../../controllers/rutas.controllers.php?op=insertar";
  } else {
    url = "../../controllers/rutas.controllers.php?op=actualizar";
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
        Swal.fire('Categoria de Rutas', 'Se guardo con exito', 'success');
        limpiar();
        UsuariosTabla();
      } else {
        Swal.fire('Categoria de Rutas', 'Ocurrio un error', 'danger');
      }
    },
  });
};

var uno = (ID_rutas) => {
  $.post('../../controllers/rutas.controllers.php?op=uno', {
    ID_rutas: ID_rutas
  }, (res) => {
      res= JSON.parse(res);
      $('#ID_rutas').val(res.ID_rutas);
      $('#ID_tren').val(res.ID_tren);
      $('#ID_estacion_origen').val(res.ID_estacion_origen);
      $('#ID_estacion_destino').val(res.ID_estacion_destino);
      $('#ID_fecha').val(res.ID_fecha);
      

  })
  document.getElementById('titulousuario').innerHTML = "Editar Usuarios";
  $('#ModalUsu').modal('show');
};


var eliminar = (ID_rutas) => {
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
          $.post('../../controllers/rutas.controllers.php?op=eliminar', {
            ID_rutas:ID_rutas
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
      $('#ID_rutas').val('');
      $('#ID_tren').val('');
      $('#ID_estacion_origen').val('');
      $('#ID_estacion_destino').val('');
      $('#ID_fecha').val('');
    
    $('#ModalUsu').modal('hide');
    document.getElementById('titulousuario').innerHTML = "Nuevo Usuario";
};
init();