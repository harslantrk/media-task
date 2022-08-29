<?php
namespace App\Http\Interface;
use Illuminate\Http\Request;
// Interface definition
interface MediaInterface {
  public function index();
  public function store(Request $request);
  public function show($id);
  public function update(Request $request);
  public function destroy($id);

}