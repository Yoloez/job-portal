<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\JobVacancy as Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use OpenApi\Annotations as OA;

class ApplicationApiController extends Controller
{
	/**
	 * @OA\Get(
	 *     path="/api/applications",
	 *     tags={"Applications (Admin)"},
	 *     summary="Get all applications (Admin only)",
	 *     description="Retrieve paginated list of all job applications",
	 *     security={{"bearerAuth":{}}},
	 *     @OA\Parameter(
	 *         name="page",
	 *         in="query",
	 *         description="Page number",
	 *         required=false,
	 *         @OA\Schema(type="integer", example=1)
	 *     ),
	 *     @OA\Parameter(
	 *         name="per_page",
	 *         in="query",
	 *         description="Items per page",
	 *         required=false,
	 *         @OA\Schema(type="integer", example=10)
	 *     ),
	 *     @OA\Response(
	 *         response=200,
	 *         description="Paginated applications list",
	 *         @OA\JsonContent(
	 *             @OA\Property(property="current_page", type="integer", example=1),
	 *             @OA\Property(property="data", type="array",
	 *                 @OA\Items(
	 *                     @OA\Property(property="id", type="integer", example=1),
	 *                     @OA\Property(property="user_id", type="integer", example=1),
	 *                     @OA\Property(property="job_id", type="integer", example=1),
	 *                     @OA\Property(property="cv", type="string", example="cvs/document.pdf"),
	 *                     @OA\Property(property="status", type="string", example="Pending"),
	 *                     @OA\Property(property="user", type="object",
	 *                         @OA\Property(property="name", type="string", example="John Doe"),
	 *                         @OA\Property(property="email", type="string", example="john@example.com")
	 *                     ),
	 *                     @OA\Property(property="job", type="object",
	 *                         @OA\Property(property="title", type="string", example="Software Engineer"),
	 *                         @OA\Property(property="company", type="string", example="Tech Corp")
	 *                     )
	 *                 )
	 *             ),
	 *             @OA\Property(property="total", type="integer", example=50)
	 *         )
	 *     ),
	 *     @OA\Response(response=403, description="Forbidden - Admin only")
	 * )
	 */
	public function index(Request $req)
	{
		if (!$req->user() || $req->user()->role !== 'admin') {
			return response()->json(['message' => 'Forbidden'], 403);
		}
		$apps = Application::with(['user', 'job'])
			->latest()
			->paginate($req->get('per_page', 10));
		return response()->json($apps);
	}

	/**
	 * @OA\Post(
	 *     path="/api/jobs/{id}/apply",
	 *     tags={"Applications"},
	 *     summary="Apply for a job",
	 *     description="Submit job application with CV upload",
	 *     security={{"bearerAuth":{}}},
	 *     @OA\Parameter(
	 *         name="id",
	 *         in="path",
	 *         description="Job ID",
	 *         required=true,
	 *         @OA\Schema(type="integer", example=1)
	 *     ),
	 *     @OA\RequestBody(
	 *         required=true,
	 *         @OA\MediaType(
	 *             mediaType="multipart/form-data",
	 *             @OA\Schema(
	 *                 required={"cv"},
	 *                 @OA\Property(
	 *                     property="cv",
	 *                     type="string",
	 *                     format="binary",
	 *                     description="CV file (PDF, max 2MB)"
	 *                 )
	 *             )
	 *         )
	 *     ),
	 *     @OA\Response(
	 *         response=201,
	 *         description="Application submitted successfully",
	 *         @OA\JsonContent(
	 *             @OA\Property(property="message", type="string", example="Application submitted"),
	 *             @OA\Property(property="application", type="object",
	 *                 @OA\Property(property="id", type="integer", example=1),
	 *                 @OA\Property(property="user_id", type="integer", example=1),
	 *                 @OA\Property(property="job_id", type="integer", example=1),
	 *                 @OA\Property(property="cv", type="string", example="cvs/document.pdf"),
	 *                 @OA\Property(property="status", type="string", example="Pending")
	 *             )
	 *         )
	 *     ),
	 *     @OA\Response(response=401, description="Unauthenticated"),
	 *     @OA\Response(response=422, description="Validation error")
	 * )
	 */
	public function store(Request $req, Job $job)
	{
		$req->validate([
			'cv' => 'required|file|mimes:pdf|max:2048',
		]);

		$cvPath = $req->file('cv')->store('cvs', 'public');
		$app = Application::create([
			'user_id' => $req->user()->id,
			'job_id' => $job->id,
			'cv' => $cvPath,
			'status' => 'Pending',
		]);

		return response()->json(['message' => 'Application submitted', 'application' => $app], 201);
	}

	/**
	 * @OA\Put(
	 *     path="/api/applications/{id}/status",
	 *     tags={"Applications (Admin)"},
	 *     summary="Update application status (Admin only)",
	 *     description="Accept or reject job application",
	 *     security={{"bearerAuth":{}}},
	 *     @OA\Parameter(
	 *         name="id",
	 *         in="path",
	 *         description="Application ID",
	 *         required=true,
	 *         @OA\Schema(type="integer", example=1)
	 *     ),
	 *     @OA\RequestBody(
	 *         required=true,
	 *         @OA\JsonContent(
	 *             required={"status"},
	 *             @OA\Property(
	 *                 property="status",
	 *                 type="string",
	 *                 enum={"Accepted", "Rejected"},
	 *                 example="Accepted"
	 *             )
	 *         )
	 *     ),
	 *     @OA\Response(
	 *         response=200,
	 *         description="Status updated successfully",
	 *         @OA\JsonContent(
	 *             @OA\Property(property="message", type="string", example="Status updated"),
	 *             @OA\Property(property="application", type="object",
	 *                 @OA\Property(property="id", type="integer", example=1),
	 *                 @OA\Property(property="status", type="string", example="Accepted")
	 *             )
	 *         )
	 *     ),
	 *     @OA\Response(response=403, description="Forbidden - Admin only"),
	 *     @OA\Response(response=404, description="Application not found"),
	 *     @OA\Response(response=422, description="Validation error")
	 * )
	 */
	public function updateStatus(Request $req, Application $application)
	{
		if (!$req->user() || $req->user()->role !== 'admin') {
			return response()->json(['message' => 'Forbidden'], 403);
		}

		$req->validate([
			'status' => 'required|in:Accepted,Rejected',
		]);

		$application->update([
			'status' => $req->input('status'),
		]);

		return response()->json(['message' => 'Status updated', 'application' => $application]);
	}
}