<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\JobVacancy as Job;
use Illuminate\Http\Request;

class JobApiController extends Controller
{
	public function index(Request $req)
	{
		// optional search & pagination
		$q = Job::query();
		if ($req->filled('keyword')) {
			$kw = $req->input('keyword');
			$q->where(function ($s) use ($kw) {
				$s->where('title', 'like', "%{$kw}%")
					->orWhere('company', 'like', "%{$kw}%")
					->orWhere('location', 'like', "%{$kw}%");
			});}
		$perPage = (int) $req->get('per_page', 10);
		$jobs = $q->orderBy('created_at', 'desc')->paginate($perPage);
		return response()->json($jobs);
	}

	public function show(Job $job)
	{return response()->json($job);}

	public function store(Request $req)
	{
		// cek role admin
		if (!$req->user() || $req->user()->role !== 'admin') {
			return response()->json(['message' => 'Forbidden'], 403);
		}
		$data = $req->validate([
			'title' => 'required|string',
			'description' => 'required|string',
			'location' => 'required|string',
			'company' => 'required|string',
			'salary' => 'nullable|integer',
			'logo' => 'nullable|string',
		]);
		$job = Job::create($data);
		return response()->json(['message' => 'Created', 'job' => $job], 201);
    }
	public function update(Request $req, Job $job)
	{
		if (!$req->user() || $req->user()->role !== 'admin') {
			return response()->json(['message' => 'Forbidden'], 403);
		}
		$data = $req->validate([
			'title' => 'sometimes|required|string',
			'description' => 'sometimes|required|string',
			'location' => 'sometimes|required|string',
			'company' => 'sometimes|required|string',
			'salary' => 'nullable|integer',
			'logo' => 'nullable|string',
		]);
		$job->update($data);
		return response()->json(['message' => 'Updated', 'job' => $job]);}
	public function destroy(Request $req, Job $job)
	{
		if (!$req->user() || $req->user()->role !== 'admin') {
			return response()->json(['message' => 'Forbidden'], 403);
		}
		$job->delete();
		return response()->json(['message' => 'Deleted']);
	}
}