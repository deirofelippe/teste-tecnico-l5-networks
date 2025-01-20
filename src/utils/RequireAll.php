<?php

declare(strict_types=1);

date_default_timezone_set('America/Sao_Paulo');

require_once __DIR__ . '/../Env.php';
require_once __DIR__ . '/../utils/Utils.php';
require_once __DIR__ . '/../DatabaseSingleton.php';

require_once __DIR__ . '/../Logger.php';
require_once __DIR__ . '/../Cache.php';
require_once __DIR__ . '/../HttpClient.php';

require_once __DIR__ . '/../models/Log.php';

require_once __DIR__ . '/../services/FindAllFilmsService.php';
require_once __DIR__ . '/../services/FindFilmByIdService.php';
require_once __DIR__ . '/../services/ShowLogsService.php';
require_once __DIR__ . '/../services/CreateCommentService.php';
require_once __DIR__ . '/../services/GetAuthorsCommentsService.php';

require_once __DIR__ . '/../repositories/LogsRepository.php';
require_once __DIR__ . '/../repositories/CommentsRepository.php';

require_once __DIR__ . '/../internals/View.php';

require_once __DIR__ . '/../controllers/ShowLogsController.php';
require_once __DIR__ . '/../controllers/FindAllFilmsController.php';
require_once __DIR__ . '/../controllers/FindFilmByIdController.php';
require_once __DIR__ . '/../controllers/CreateCommentController.php';
require_once __DIR__ . '/../controllers/GetAuthorsCommentsController.php';
