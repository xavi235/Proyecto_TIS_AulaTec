<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\mensajeEvent;
use App\Notifications\notificaciones;
use App\Models\Mensaje;
use App\Models\User;
use App\Models\Reserva;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Ambiente;
use App\Models\AmbienteHorario;
use App\Models\TipoAmbiente;
use App\Mail\ConfirmacionSolicitud; // Asegúrate de tener el namespace correcto para la clase ConfirmarReserva
use Illuminate\Support\Facades\Mail;
use DateTime; 

class mensajeController extends Controller
{
    public function create()
    {
        return view('mensaje.create');
    }

    public function store(Request $request)
    {
        $data               = $request->all();
        $data['user_id']    = Auth::id();
        $post               = Mensaje::create($data);
        event(new mensajeEvent($post));
        return redirect()->back()->with('message', 'Reserva enviada');
    }

    public function enviarSolicitud(Request $request, $idusuario_materias)
    {
        $data                       = $request->all();
        $data['user_id']            = Auth::id();
        $data['idusuario_materias'] = $idusuario_materias;
        $horariosSeleccionados      = $request->input('horario');

        foreach ($horariosSeleccionados as $horario) {
            $data['horario']    = $horario;
            $mensaje            = Mensaje::create($data);        
            event(new mensajeEvent($mensaje));
        }
        return redirect()->back()->with('message', 'Reserva enviada');
    }
    public function index()
    {
        $reservas = $this->listReservas();
        return view('mensaje.notifications', compact('reservas'));
    }

    public function unico($id)
    {
        $reservas = $this->listReservas();
        return view('mensaje.detalle', compact('reservas', 'id'));
    }

    public function listReservas()
    {
        $reservas = DB::table(DB::raw('(SELECT @rownum := 0) r'))
            ->join('reservas', function ($join) {
                $join->on(DB::raw('true'), '=', DB::raw('true'));
            })
            ->join('usuario_materias', 'reservas.id_usuario_materia', '=', 'usuario_materias.id')
            ->join('users', 'usuario_materias.id_user', '=', 'users.id')
            ->join('grupo_materias', 'usuario_materias.id_grupo_materia', '=', 'grupo_materias.id')
            ->join('materias', 'grupo_materias.id_materia', '=', 'materias.id')
            ->join('grupos', 'grupo_materias.id_grupo', '=', 'grupos.id')
            ->join('acontecimientos', 'reservas.id_acontecimiento', '=', 'acontecimientos.id')
            ->join('tipo_ambientes', 'reservas.id_tipoAmbiente', '=', 'tipo_ambientes.id')
            ->join('horarios', 'reservas.id_horario', '=', 'horarios.id')
            ->select(
                DB::raw('@rownum := @rownum + 1 AS id'),
                'reservas.fecha_reserva',
                'reservas.id_usuario_materia',
                'usuario_materias.id_user as id_user',
                'usuario_materias.id_grupo_materia as id_grupo_materia',
                'users.name as docente',
                'materias.nombre as materia',
                'grupos.grupo as grupo',
                'acontecimientos.tipo as acontecimiento',
                DB::raw('CONCAT(DATE_FORMAT(MIN(horarios.horaini), "%H:%i"), "-", DATE_FORMAT(MAX(horarios.horafin), "%H:%i")) AS horario'),
                'reservas.capacidad',
                'tipo_ambientes.nombre as tipo_ambiente'
            )
            ->groupBy(
                'reservas.fecha_reserva',
                'reservas.id_usuario_materia',
                'usuario_materias.id_user',
                'usuario_materias.id_grupo_materia',
                'users.name',
                'materias.nombre',
                'grupos.grupo',
                'acontecimientos.tipo',
                'reservas.capacidad',
                'tipo_ambientes.nombre'
            )
            ->orderByRaw('CASE WHEN reservas.id_acontecimiento = 5 THEN 1 ELSE 0 END ASC')
            ->orderBy('reservas.fecha_reserva', 'asc')
            ->orderBy(DB::raw('MIN(horarios.horaini)'), 'asc')
            ->get();
            return $reservas;
    }

    public function confirmarReserva($id, Request $request)
    {
        // Obtener la información necesaria de la reserva
        $ambientes = $request->input('ambientes');
        $reserva_data = $this->listReservas()->get($id);
        //dd($reserva_data);
        $userMateria = $reserva_data->id_usuario_materia;
        $idUser = DB::table("usuario_materias")->where('id', $userMateria)->value('id_user');
        $userCorreo = User::where('id', $idUser)->value('email');
        // Envía el correo electrónico de confirmación
        Mail::to($userCorreo)->send(new ConfirmacionSolicitud($reserva_data, $ambientes));
        if ($ambientes != null) {
            foreach ($ambientes as $ambiente) {
                $this->desactivarAula($ambiente, $reserva_data->fecha_reserva, $reserva_data->horario);
            }
            return redirect('/mensaje')->with('message', 'Solicitud de Reserva Enviada');
        } else {
            return redirect('/mensaje')->with('message', 'Notificacion de Aula no disponible');
        }
    }
    public function desactivarAula($ambiente, $fecha_reserva, $id_horario)
    {
        $aula = DB::table('ambientes')
            ->where('numeroaula', $ambiente)
            ->first(['id']);
        $date = $fecha_reserva;
        $dateTime = new DateTime($date);
        $dayOfWeek = $dateTime->format('l');

        $diasSemana = [
            'Monday' => 'Lunes',
            'Tuesday' => 'Martes',
            'Wednesday' => 'Miércoles',
            'Thursday' => 'Jueves',
            'Friday' => 'Viernes',
            'Saturday' => 'Sabado',
            'Sunday' => 'Domingo'
        ];

        $diaSemanaEsp = $diasSemana[$dayOfWeek];
        $dia = DB::table('dias')
            ->where('nombre', $diaSemanaEsp)
            ->value('id');
        $aulaId = $aula->id;
        $updated = DB::table('ambiente_horarios')
            ->where('id_ambiente', $aulaId)
            ->where('id_horario', $id_horario)
            ->where('id_dia', $dia)
            ->update(['id_estado_horario' => 2]);
    }
    public function markNotification(Request $request)
    {
        // Obtener el ID de la notificación de la solicitud
        $user = auth()->user();
        $notificationId = $request->id;
        // Marcar la notificación como leída
        auth()->user()->notifications()->where('id', $notificationId)->first()->markAsRead();

        // Retornar una respuesta exitosa
        return redirect()->back()->with('message', 'Reserva confirmada');
    }
    public function showAsignacionForm($id)
    {
        $departamentos = DB::table('ambientes')->distinct()->pluck('departamento');

        return view('Horario.buscar', ['id' => $id, 'departamentos' => $departamentos]);
    }
    
    public function asignarAmbiente($id, Request $request)
    {
        $capacidad = $request->query('capacidad');
        $tipo_ambiente = $request->query('tipo_ambiente');
        $horario = $request->query('horario');
    
        $departamentos = DB::table('ambientes')->distinct()->pluck('departamento');
   
        return view('Horario.buscar', [
            'id' => $id,
            'capacidad' => $capacidad,
            'tipo_ambiente' => $tipo_ambiente,
            'horario' => $horario,
            'departamentos' => $departamentos
        ]);
    }
    public function buscarAmbientes(Request $request)
    {
        $capacidad = $request->input('capacidad');
        $tipo_ambiente = $request->input('tipo_ambiente');
        $horario = $request->input('horario');
    
        $ambientes = DB::table('ambientes as a')
            ->join('ambiente_horarios as ah', 'a.id', '=', 'ah.id_ambiente')
            ->join('ubicacions as u', 'a.id_ubicacion', '=', 'u.id')
            ->join('dias as d', 'ah.id_dia', '=', 'd.id')
            ->join('estado_horarios as e', 'ah.id_estado_horario', '=', 'e.id')
            ->join('horarios as h', 'ah.id_horario', '=', 'h.id')
            ->where('a.capacidad', $capacidad)
            ->where('a.id_tipoAmbiente', function($query) use ($tipo_ambiente) {
                $query->select('id')
                      ->from('tipo_ambientes')
                      ->where('nombre', $tipo_ambiente);
            })
            ->where('ah.id_estado_horario', 1)
            ->where('h.horaini', $horario)
            ->where('e.id', 1)
            ->select('a.numeroaula')
            ->get();
    
        return response()->json($ambientes);
    }
    public function getUbicaciones(Request $request)
    {
        $departamento = $request->input('departamento');
        $ubicaciones = DB::table('ambientes as a')
            ->join('ubicacions as u', 'a.id_ubicacion', '=', 'u.id')
            ->where('a.departamento', $departamento)
            ->distinct()
            ->pluck('u.nombre');

        return response()->json($ubicaciones);
    }
    public function getAmbientes(Request $request)
    {
        $departamento = $request->input('departamento');
        $ubicacion = $request->input('ubicacion');
        $horario = $request->input('horario');

        $ambientes = DB::table('ambientes as a')
            ->join('ubicacions as u', 'a.id_ubicacion', '=', 'u.id')
            ->join('ambiente_horarios as ah', 'a.id', '=', 'ah.id_ambiente')
            ->join('horarios as h', 'ah.id_horario', '=', 'h.id')
            ->where('a.departamento', $departamento)
            ->where('u.nombre', $ubicacion)
            ->where('ah.id_estado_horario', 1)
            ->where('h.horaini', $horario)
            ->select('a.numeroaula', 'a.capacidad')
            ->get();

        return response()->json($ambientes);
    }
}