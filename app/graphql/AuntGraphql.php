<?php


namespace App\graphql;

use App\Http\Controllers\Controller;
use App\Service\AuntService;
use GraphQL\Type\Definition\ResolveInfo;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;


class AuntGraphql extends Controller
{
    protected $auntService;

    public function __construct(AuntService $auntService)
    {
        $this->auntService = $auntService;
        $this->middleware('jwt');
    }

    public function sign($root, $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $user_id = request()->user_id;
        $type = $args['type'];
        $date = $args['datetimes'];
        return $this->auntService->sign($type, $user_id, $date);
    }
}
