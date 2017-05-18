# Changes in DB
- Default values for _tbempresa_
- Add level 7 for _languagelevel_
- Change boolean values for _applicant_ license and move fields
    ```
     update tbalumnos set carneconducir=1 where carneconducir='VERDADERO'
     update tbalumnos set carneconducir=0 where carneconducir='FALSO'
     ```
     And:
     ```
          * update tbalumnos set desplazamiento=0 where desplazamiento='FALSO'
          * update tbalumnos set desplazamiento=1 where desplazamiento='VERDADERO'
     ```
- Added default company for _tbsolicitudes_ , id:1
- Added tbschooldegree
- Added idalumno in tbalumnosestudios, change dni to id
- Added idprofesor in tbprofescursos, change nif to id

- Added status field on tbsolicitudes, default value 1
ALTER TABLE `tbsolicitudes` ADD `status` INT NOT NULL DEFAULT '1' AFTER `valoracion`;
- Created new table: 
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbsolicitudes_estado`
--

INSERT INTO `tbsolicitudes_estado` (`id`, `name`, `description`) VALUES
(1, 'INICIADA', ''),
(2, 'PRESELECCIÓN', ''),
(4, 'SELECCIÓN', ''),
(5, 'EMAIL ENVIADO', ''),
(6, 'VALORADA', '');