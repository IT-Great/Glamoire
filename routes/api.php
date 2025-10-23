use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BiteshipController;

Route::post('/callback-glamoire-with-biteship', [BiteshipController::class, 'callback']);
