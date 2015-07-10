<?php
/**
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */

namespace WebRequest;

/**
 * Classe para realizar as chamadas de requisição via STREAM.
 */
class Stream extends HttpRequest
{
    /**
     * Construtor para a classe de requisições Web utilizando Stream para leitura dos dados.
     */
    protected function __construct()
    {
    }

    /**
     * @see IHttpRequest::execute()
     */
    public function execute($url, $data = [], $method = 'GET', $header = [])
    {
        $return = null;

        // Inicializa a variaveis para o envio de dados.
        $str_data = '';
        // Caso existam dados a serem construidos, transforma em formato para a url.
        if(count($data) > 0)
            $str_data = http_build_query($data);

        // Caso seja uma requisição get e tenha dados, adiciona estes dados ao final da url.
        if($method == 'GET' && strlen($str_data) > 0)
        {
            $url .= '?' . $str_data;
            $data = [];
        }

        // Constroi os parametros a serem enviados pelo stream_create_context
        $cparams = [
            'http' => [
                'method' => $method,
                'header' => implode('\n', $header),
                'content' => $str_data,
                'ignore_errors' => true
            ]
        ];
        // Se for uma requisição get, apaga o conteudo a ser enviado. Somente para as outras
        //  requisições.
        if($cparams['http']['method'] == 'GET')
        {
            unset($cparams['http']['content']);
        }

        // Cria o contexto para o stream, abre a leitura e retorna os dados.
        $stream = stream_context_create($cparams);
        $fp = fopen($url, 'rb', false, $stream);
        $return = stream_get_contents($fp);
        fclose($fp);

        return $return;
    } // fim - public function execute($url, $data = [], $method = 'GET', $header = [])
}

