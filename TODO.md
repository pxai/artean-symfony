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