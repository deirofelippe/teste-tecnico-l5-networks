<?php

declare(strict_types=1);

date_default_timezone_set("America/Sao_Paulo");

require_once __DIR__."/../Env.php";
require_once __DIR__."/../utils/Utils.php";
require_once __DIR__."/../DatabaseSingleton.php";

require_once __DIR__."/../Logger.php";
require_once __DIR__."/../Cache.php";
require_once __DIR__."/../HttpClient.php";

require_once __DIR__."/../models/Log.php";

require_once __DIR__."/../FindAllFilms.php";
require_once __DIR__."/../FindFilmById.php";
require_once __DIR__."/../services/ShowLogsService.php";

require_once __DIR__."/../repositories/LogsRepository.php";

require_once __DIR__."/../internals/View.php";

require_once __DIR__."/../controllers/ShowLogsController.php";
require_once __DIR__."/../controllers/FindAllFilmsController.php";
require_once __DIR__."/../controllers/FindFilmByIdController.php";
