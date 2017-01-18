<?php
/**
 * Created by PhpStorm.
 * User: xiodine
 * Date: 1/8/2017
 * Time: 9:19 PM
 */

namespace Controllers\Admin;


use App\Database;
use App\File;
use App\FileData;
use App\Json;
use App\Request;
use App\Response;
use Models\Statistic;

class Stats extends ControllerAdmin
{

    /**
     * @param $request Request
     * @return Response
     */
    protected function viewAdmin(Request $request)
    {
        if (!$request->session('user'))
            return new Json(true);

        if ($request->session('user')->hasRole(\Models\User::ADMINISTRATOR)) {
            if ($request->hasGet(['download'])) {
                $id = intval($request->get('download'));
                if ($id === 1) {
                    $query = $this->constructWhere($request->get('range', 'all'));
                    return new File($this->constructD($query));
                }
                if ($id === 2) {
                    return new File($this->constructD2());
                }

            }
        }

        $d = $this->constructD('ORDER BY created_at DESC LIMIT 15');

        $d2 = $this->constructD2();


        return new Json(["last" => $d->readable(), 'pages' => $d2->readable()]);
    }

    private function constructWhere($range)
    {
        $prefix = "WHERE created_at >= NOW() - INTERVAL 1 ";
        $postfix = " ORDER BY created_at DESC";
        switch ($range) {
            case 'hour':
                return $prefix . "HOUR" . $postfix;
            case 'day':
                return $prefix . "DAY" . $postfix;
            case 'week':
                return $prefix . "WEEK" . $postfix;
            case 'year':
                return $prefix . "YEAR" . $postfix;
            default:
                return $postfix;
        }
    }

    /**
     * @param $query string
     * @return FileData
     */
    protected function constructD($query)
    {
        $d = new FileData();
        $d->add('Type');
        $d->add('Request');
        $d->add('Date');
        $d->add('Session ID');
        $d->nextline();
        foreach (Statistic::all($query) as $item) {
            /**
             * @var $item \Models\Statistic
             */

            $d->addLine([
                $item->request_method,
                $item->request_uri,
                $item->created_at,
                $item->session_id === session_id() ? "you" : $item->session_id
            ]);
        }
        return $d;
    }

    /**
     * @return FileData
     */
    protected function constructD2()
    {
        $d2 = new FileData();
        $d2->addLine(['Page', 'Visits last hour', 'Visits last day', 'Visits total']);
        $ra = [];

        foreach (Database::singleton()->getAll("SELECT request_uri page, COUNT(*) AS hour FROM statistics WHERE request_method <> 'PUT' AND created_at >= NOW() - INTERVAL 1 HOUR GROUP BY request_uri ORDER BY hour DESC") as $item) {
            if (empty($ra[$item["page"]]))
                $ra[$item["page"]] = [];
            $ra[$item["page"]][] = $item["hour"];
        }
        foreach (Database::singleton()->getAll("SELECT request_uri page, COUNT(*) AS day FROM statistics WHERE request_method <> 'PUT' AND created_at >= NOW() - INTERVAL 1 DAY GROUP BY request_uri ORDER BY day DESC") as $item) {
            if (empty($ra[$item["page"]]))
                $ra[$item["page"]] = [];
            $ra[$item["page"]][] = $item["day"];
        }

        foreach (Database::singleton()->getAll("SELECT request_uri page, COUNT(*) AS total FROM statistics WHERE request_method <> 'PUT' GROUP BY request_uri ORDER BY total DESC") as $item) {
            if (empty($ra[$item["page"]]))
                $ra[$item["page"]] = [];
            $ra[$item["page"]][] = $item["total"];
        }
        foreach ($ra as $page => $val) {
            @list($hour, $day, $total) = $val;
            $d2->addLine([$page, $hour, $day, $total]);
        }
        return $d2;
    }
}
