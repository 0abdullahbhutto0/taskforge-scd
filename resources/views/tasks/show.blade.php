<x-sidebar>
    <div class="w-full bg-gray-50 min-h-screen">
        <div class="p-6">
            <div class="mb-6">
                <div class="flex items-center gap-4 mb-2">
                    <a href="/tasks" class="text-blue-600 hover:text-blue-700 text-sm">← Back to Tasks</a>
                </div>
                <h1 class="text-2xl font-bold text-gray-900">{{ $task->title }}</h1>
                <p class="text-gray-600">{{ $task->workspace->name ?? 'No workspace' }}</p>
            </div>

            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="lg:col-span-2">
                    <!-- Task Details -->
                    <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
                        <h2 class="text-xl font-bold text-gray-900 mb-4">Task Details</h2>

                        <div class="space-y-4">
                            <div>
                                <label class="text-sm font-medium text-gray-700">Description</label>
                                <p class="text-gray-900 mt-1">{{ $task->description ?? 'No description provided' }}</p>
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                @if ($task->assigned_to === auth()->id())
                                    <div>
                                        <label class="text-sm font-medium text-gray-700">Status</label>
                                        <form action="/tasks/{{ $task->id }}/status" method="POST" class="mt-1">
                                            @csrf
                                            <select name="status" onchange="this.form.submit()"
                                                class="text-sm border rounded px-3 py-2 w-full text-black bg-white">
                                                <option value="todo" {{ $task->status->value === 'todo' ? 'selected' : '' }}>
                                                    To Do</option>
                                                <option value="in_progress"
                                                    {{ $task->status->value === 'in_progress' ? 'selected' : '' }}>In Progress
                                                </option>
                                                <option value="review"
                                                    {{ $task->status->value === 'review' ? 'selected' : '' }}>Review</option>
                                                <option value="completed"
                                                    {{ $task->status->value === 'completed' ? 'selected' : '' }}>Completed
                                                </option>
                                                <option value="blocked"
                                                    {{ $task->status->value === 'blocked' ? 'selected' : '' }}>Blocked</option>
                                            </select>
                                        </form>
                                    </div>
                                @endif
                                <div>
                                    <label class="text-sm font-medium text-gray-700">Priority</label>
                                    <div class="mt-1">
                                        @if ($task->priority->value === 'critical' || $task->priority->value === 'high')
                                            <span
                                                class="bg-red-100 text-red-700 px-3 py-2 rounded text-sm font-medium inline-block">{{ $task->priority->label() }}</span>
                                        @elseif($task->priority->value === 'medium')
                                            <span
                                                class="bg-orange-100 text-orange-700 px-3 py-2 rounded text-sm font-medium inline-block">{{ $task->priority->label() }}</span>
                                        @else
                                            <span
                                                class="bg-green-100 text-green-700 px-3 py-2 rounded text-sm font-medium inline-block">{{ $task->priority->label() }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div>
                                <label class="text-sm font-medium text-gray-700">Due Date</label>
                                <p class="text-gray-900 mt-1">
                                    {{ $task->due_date ? $task->due_date->format('M d, Y') : 'No due date' }}</p>
                            </div>

                            <div>
                                <label class="text-sm font-medium text-gray-700">Assigned To</label>
                                <div class="flex items-center gap-2 mt-1">
                                    <div
                                        class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 font-medium text-sm">
                                        {{ substr($task->assignedTo->name ?? 'N', 0, 1) }}
                                    </div>
                                    <span class="text-gray-900">{{ $task->assignedTo->name ?? 'Unassigned' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Comments Section -->
                    <div class="bg-white rounded-lg shadow-sm p-6">
                        <h2 class="text-xl font-bold text-gray-900 mb-4">Comments</h2>

                        <div class="space-y-4 mb-6">
                            @foreach ($task->comments as $comment)
                                <div class="border-l-4 border-blue-500 pl-4 py-2">
                                    <div class="flex items-center gap-2 mb-2">
                                        <div
                                            class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 font-medium text-sm">
                                            {{ substr($comment->user->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <div class="font-medium text-gray-900 text-sm">{{ $comment->user->name }}
                                            </div>
                                            <div class="text-xs text-gray-500">
                                                {{ $comment->created_at->diffForHumans() }}</div>
                                        </div>
                                    </div>
                                    <p class="text-gray-700">{{ $comment->comment }}</p>
                                </div>
                            @endforeach
                        </div>

                        @if ($task->comments->isEmpty())
                            <p class="text-gray-500 text-center py-4 mb-6">No comments yet. Be the first to comment!</p>
                        @endif

                        <!-- Add Comment Form -->
                        <form action="/tasks/{{ $task->id }}/comments" method="POST">
                            @csrf
                            <div>
                                <label for="comment" class="block text-sm font-medium text-gray-700 mb-2">Add a
                                    comment</label>
                                <textarea id="comment" name="comment" rows="3" required
                                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm text-black"
                                    placeholder="Write your comment here..."></textarea>
                            </div>
                            <div class="mt-3">
                                <button type="submit"
                                    class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-700">
                                    Post Comment
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <div>
                    <div class="bg-white rounded-lg shadow-sm p-6">
                        <h3 class="font-bold text-gray-900 mb-4">Task Info</h3>
                        <div class="space-y-3 text-sm">
                            <div>
                                <span class="text-gray-600">Created by:</span>
                                <span
                                    class="text-gray-900 font-medium ml-2">{{ $task->creator->name ?? 'Unknown' }}</span>
                            </div>
                            <div>
                                <span class="text-gray-600">Created:</span>
                                <span
                                    class="text-gray-900 font-medium ml-2">{{ $task->created_at->format('M d, Y') }}</span>
                            </div>
                            <div>
                                <span class="text-gray-600">Last updated:</span>
                                <span
                                    class="text-gray-900 font-medium ml-2">{{ $task->updated_at->diffForHumans() }}</span>
                            </div>
                            <div>
                                <span class="text-gray-600">Comments:</span>
                                <span class="text-gray-900 font-medium ml-2">{{ $task->comments->count() }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Attachments -->
                    <div class="bg-white rounded-lg shadow-sm p-6 mt-6">
                        <h3 class="font-bold text-gray-900 mb-4">Attachments 
                            <span class="text-xs font-normal text-gray-500 bg-gray-100 px-2 py-1 rounded ml-2">{{ $task->attachments->count() }} Files</span>
                        </h3>
                        
                        <!-- Upload Form -->
                        <form action="/tasks/{{ $task->id }}/attachments" method="POST" enctype="multipart/form-data" class="mb-4">
                            @csrf
                            <div class="flex items-center gap-2">
                                <input type="file" name="attachment" required
                                    class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" />
                                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded text-sm font-medium hover:bg-blue-700 shrink-0">
                                    Upload
                                </button>
                            </div>
                            @error('attachment')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </form>

                        <div class="space-y-3">
                            @forelse ($task->attachments as $attachment)
                                <div class="flex items-center justify-between p-3 border border-gray-200 rounded-lg hover:bg-gray-50 group">
                                    <div class="flex items-center gap-3 overflow-hidden">
                                        <div class="w-8 h-8 bg-blue-100 rounded flex items-center justify-center text-blue-600 shrink-0">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                                            </svg>
                                        </div>
                                        <div class="min-w-0">
                                            <p class="text-sm font-medium text-gray-900 truncate" title="{{ $attachment->filename }}">
                                                {{ $attachment->filename }}
                                            </p>
                                            <p class="text-xs text-gray-500">
                                                By {{ $attachment->user->name ?? 'Unknown' }} • {{ $attachment->created_at->format('M d, Y') }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                        <a href="/attachments/{{ $attachment->id }}/download" class="text-gray-500 hover:text-blue-600 p-1" title="Download">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                            </svg>
                                        </a>
                                        <form action="/attachments/{{ $attachment->id }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-gray-500 hover:text-red-600 p-1" title="Delete" onclick="return confirm('Delete this file?')">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @empty
                                <p class="text-sm text-gray-500 text-center py-4">No attachments yet.</p>
                            @endforelse
                        </div>
                    </div>
                    <!-- Activity History -->
                    <div class="bg-white rounded-lg shadow-sm p-6 mt-6">
                        <h3 class="font-bold text-gray-900 mb-4">Activity History</h3>
                        <div class="space-y-4">
                            @forelse ($task->activities as $activity)
                                <div class="text-sm">
                                    <div class="flex items-center gap-2">
                                        <div class="w-6 h-6 bg-gray-100 rounded-full flex items-center justify-center text-gray-600 font-medium text-xs">
                                            {{ substr($activity->user->name ?? 'S', 0, 1) }}
                                        </div>
                                        <span class="font-medium text-gray-900">{{ $activity->user->name ?? 'System' }}</span>
                                    </div>
                                    <div class="ml-8 mt-1 text-gray-600 border-l-2 border-gray-200 pl-3">
                                        @if($activity->description === 'created_task')
                                            <p>Created the task</p>
                                        @elseif($activity->description === 'updated_task')
                                            <p>Updated task details</p>
                                            @if($activity->new_values)
                                                <ul class="list-disc ml-4 mt-1 text-xs text-gray-500">
                                                    @foreach($activity->new_values as $key => $value)
                                                        @if(!in_array($key, ['updated_at']))
                                                            <li>Changed <strong>{{ $key }}</strong></li>
                                                        @endif
                                                    @endforeach
                                                </ul>
                                            @endif
                                        @endif
                                        <p class="text-xs text-gray-400 mt-1">{{ $activity->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                            @empty
                                <p class="text-sm text-gray-500 text-center">No recent activity.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-sidebar>
