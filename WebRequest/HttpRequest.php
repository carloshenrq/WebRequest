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
 * Classe abstrata para requisições.
 *
 * @abstract
 */
abstract class HttpRequest implements IHttpRequest
{
    use TGlobal;

    /**
     * @see IHttpRequest::parseReturn()
     */
    final public function parseReturn($returnData, $format = 'json')
    {
        return (($format == 'text') ? $returnData : 
                    (($format == 'json') ? json_decode($returnData) : 
                        (($format == 'xml') ? simplexml_load_string($returnData):null)));
    }

    /**
     * @see IHttpRequest::get()
     */
    final public function get($url, $data = [], $format = 'json')
    {
        return $this->parseReturn($this->execute($url, $data), $format);
    }

    /**
     * @see IHttpRequest::post()
     */
    final public function post($url, $data = [], $format = 'json')
    {
        return $this->parseReturn($this->execute($url, $data, 'POST',
                ['Content-Type: application/x-www-form-urlencoded']), $format);
    }

    /**
     * @see IHttpRequest::put()
     */
    final public function put($url, $data = [], $format = 'json')
    {
        return $this->parseReturn($this->execute($url, $data, 'PUT',
                ['Content-Type: application/x-www-form-urlencoded']), $format);
    }

    /**
     * @see IHttpRequest::delete()
     */
    final public function delete($url, $data = [], $format = 'json')
    {
        return $this->parseReturn($this->execute($url, $data, 'DELETE',
                ['Content-Type: application/x-www-form-urlencoded']), $format);
    }

    /**
     * Cria a instância para as requisições.
     * Tentará criar a instância para o cURL, caso não consiga, irá criar pelo Stream.
     *
     * @return IHttpRequest
     */
    public static function createInstance()
    {
        try
        {
            return cURL::getInstance();
        }
        catch(\Exception $ex)
        {
            return Stream::getInstance();
        }
    }
}
